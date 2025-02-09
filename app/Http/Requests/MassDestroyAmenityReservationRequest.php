<?php

namespace App\Http\Requests;

use App\Models\AmenityReservation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAmenityReservationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('amenity_reservation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:amenity_reservations,id',
        ];
    }
}
