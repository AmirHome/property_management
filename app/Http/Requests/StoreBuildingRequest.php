<?php

namespace App\Http\Requests;

use App\Models\Building;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBuildingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('building_create');
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
