<?php

namespace App\Http\Requests;

use App\Ride;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRideRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ride_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'destination_id'          => [
                [
                    'required',
                    'integer',
                ],
            ],
            'name' => [
                [
                    'string',
                    'required',
                ],
            ],
            'description'   => [
                [
                    'string',
                    'required',
                ],
            ],
            'price'  => [
                [
                    'required',
                    'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                ],
            ],
            'arrival_time'    => [
                [
                    'required',
                    'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                ],
            ],
            'is_booking_open' => [
                [
                    'nullable',
                    'boolean',
                ],
            ],
        ];
    }
}
