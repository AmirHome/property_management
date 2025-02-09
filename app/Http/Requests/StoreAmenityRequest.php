<?php

namespace App\Http\Requests;

use App\Models\Amenity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAmenityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('amenity_create');
    }

    public function rules()
    {
        return [
            'building_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
