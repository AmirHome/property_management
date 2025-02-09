<?php

namespace App\Http\Requests;

use App\Models\Contract;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContractRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contract_edit');
    }

    public function rules()
    {
        return [
            'unit_id' => [
                'required',
                'integer',
            ],
            'start' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'contract_file' => [
                'array',
                'required',
            ],
            'contract_file.*' => [
                'required',
            ],
            'contract_link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
