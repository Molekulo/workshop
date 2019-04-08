<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateServiceRequest
 * @package App\Http\Requests
 */
class CreateServiceRequest extends FormRequest
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
            'name'     => ['required', 'min:2', 'max:50'],
            'duration' => ['required', 'date_format:H:i', 'after_or_equal:00:30'],
            'type'     => ['sometimes'],
            'cycle'    => ['required_unless:type,non-cyclic', 'nullable', 'max:7', 'digits_between:1,7'],
        ];
    }
}
