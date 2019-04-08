<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostCarServiceRequest
 * @package App\Http\Requests
 */
class CreateCarServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'car_id' => ['required'],
            'service_id' => ['required'],
            'done_service' => ['required'],
            //'next_service' => ['required'],
        ];
    }
}
