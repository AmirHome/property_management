<?php

namespace App\Http\Requests;

use App\Models\Unit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUnitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unit_create');
    }

    public function rules()
    {
        return [
            'building_id' => [
                'required',
                'integer',
            ],
            'unit_number' => [
                'string',
                'nullable',
            ],
            'landlord_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
