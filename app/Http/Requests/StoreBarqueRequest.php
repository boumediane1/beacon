<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarqueRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'name' => ['required', 'min:3'],
            'registration_number' => ['required', 'min:3', 'unique:barques'],
            'beacon_id' => ['required'],
            'activity_id' => ['required'],
            'city_id' => ['required'],
            'port_id' => ['required']
        ];
    }
}
