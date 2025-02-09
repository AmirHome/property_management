<?php

namespace App\Http\Requests;

use App\Models\Building;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBuildingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('building_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
        ];
    }
}
