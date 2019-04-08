<?php

namespace App\Http\Requests;

use App\Car;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PutCarRequest
 * @package App\Http\Requests
 * @property  Car $car
 */
class UpdateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->hasRole('admin')) {
            return false;
        }
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
            'mark'          => ['required', 'min:2', 'max:50'],
            'model'         => ['required', 'min:2', 'max:50'],
            'plate'         => ['required', 'min:5', 'max:15', 'unique:cars,plate,' . $this->car . ''],
            'year'          => ['required', 'min:4', 'digits:4'],
            'engine_volume' => ['required', 'min:3', 'max:5', 'digits_between:3,5'],
            'horse_power'   => ['required', 'min:1', 'max:5', 'digits_between:1,5'],
            'fuel'          => ['required'],
            'kilometers'    => ['required', 'max:7', 'digits_between:1,7'],
        ];
    }
}
