<?php

namespace App\Http\Requests;

use App\Models\MaintenanceRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMaintenanceRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('maintenance_request_create');
    }

    public function rules()
    {
        return [
            'unit_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'description' => [
                'string',
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
