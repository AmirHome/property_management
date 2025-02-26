<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    use MediaUploadingTrait;


    public function index(Request $request)
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = $request->user();

        if ($user->roles->contains('id', 1)) { // Check if the user has the 'Admin' role (role ID 1)
            $users = User::with(['roles', 'team'])->get();
        } else {
            // Check if the current user is the owner of the team
            $team = $user->team;
            if ($team && $team->owner_id === $user->id) {
                    $users = User::where('team_id', $team->id)->with(['roles', 'team'])->get();
            }
            else{
                //show only current user info
                $users = User::where('id', $user->id)->with(['roles', 'team'])->get();
            }
        }

        return new UserResource($users);
    }
    

    //     return new UserResource(User::with(['roles', 'team'])->get());


    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('picture', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['roles', 'team']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('picture', false)) {
            if (! $user->picture || $request->input('picture') !== $user->picture->file_name) {
                if ($user->picture) {
                    $user->picture->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
            }
        } elseif ($user->picture) {
            $user->picture->delete();
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
