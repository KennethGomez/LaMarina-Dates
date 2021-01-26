<?php

namespace App\Http\Requests\Appointments;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tutor' => 'required',
            'student' => 'required',
            'course' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'month' => 'required|numeric',
            'day' => 'required|numeric',
            'hour' => 'required|numeric',
        ];
    }
}
