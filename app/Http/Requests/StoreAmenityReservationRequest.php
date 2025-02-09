<?php

namespace App\Http\Requests;

use App\Models\AmenityReservation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAmenityReservationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('amenity_reservation_create');
    }

    public function rules()
    {
        return [
            'amenity_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'start' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'end' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
