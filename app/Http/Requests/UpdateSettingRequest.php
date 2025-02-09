<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('setting_edit');
    }

    public function rules()
    {
        return [
            'central_hospital_mail' => [
                'string',
                'required',
            ],
            'central_hospital_mail_cc' => [
                'string',
                'nullable',
            ],
            'central_hospital_mail_bcc' => [
                'string',
                'nullable',
            ],
        ];
    }
}
