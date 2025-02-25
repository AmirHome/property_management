<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // password_confirmation

            // Feature Values
            'feature_values' => ['string', 'nullable'],

            // User Profile
            'mobile' => ['string', 'nullable'],
            'first_name' => ['string', 'nullable'],
            'last_name' => ['string', 'nullable'],
        ]);
        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ], 400 );
        }

       //$user =  [ 'errors' => 'Can not register!' ];

        DB::beginTransaction();

        try {
            $user = User::create([
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'team_id'  => request()->input('team', null),
            ]);

            $user->roles()->attach(3); // Simple user role

            $user->profile()->create( $request->all());

            if (!request()->has('team')) {
                $team = \App\Models\Team::create([
                    'owner_id' => $user->id,
                    'name'     => $request->email,
                ]);

                $user->update(['team_id' => $team->id]);
            }

            $featureValues = array_filter(explode(',', $request->feature_values ?? ''));
            if(!empty($featureValues)) {
                $company = Company::create([
                    'name'     => '',
                    'phone'     => '',
                    'address'     => '',
                    'email'     => '',
                ]);

                $company->feature_values()->sync($featureValues);

                $user->companies()->sync([$company->id]);
            }
           //if(!empty($request->input('feature_values', ''))) {
           //    $company->feature_values()->sync(explode(',', $request->input('feature_values', '')));
           //}

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json( [ 'errors' => $e->getMessage() ], 400 );
        }




        return response()->json($user);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ], 400 );
        }

        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ],
                ]
            ], 422);
        }

        
        $user = User::where('email', $request->email)->first();
        
        $authToken = $user->createToken('auth-token')->plainTextToken;

        return $this->userInformation($user, $authToken);

        /*        
        $featureValueKeys = $user->companies()->first()->feature_values_concat??'';

        return response()->json(array_merge($user->toArray(), [
            'access_token' => $authToken,
            'featureValueKeys' => $featureValueKeys,
        ]));
        */
    }

    public function user(Request $request)
    {
        return $this->userInformation($request->user(), $request->bearerToken());
    }


    static public function userInformation($objUser, $token): \Illuminate\Http\JsonResponse
    {

        $profile = $objUser->profile ?? '';
        $team = $objUser->team ?? '';
        $roles = $objUser->roles->pluck('title')->implode(', ') ?? '';

        return response()->json(array_merge($objUser->toArray(), [
            'access_token' => $token,

            'profile' => $profile,
            'team' => $team,
            'roles' => $roles
        ]));
    }
}
