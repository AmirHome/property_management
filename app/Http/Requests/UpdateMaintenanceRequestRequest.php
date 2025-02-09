<?php

namespace App\Http\Requests;

use App\Models\MaintenanceRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMaintenanceRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('maintenance_request_edit');
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
