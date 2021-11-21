<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBeaconRequest extends FormRequest
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
            'uin' => ['size:15', Rule::unique('beacons')->ignore($this->beacon->id)],
            'serial_number' => ['digits:10', Rule::unique('beacons')->ignore($this->beacon->id)],
            'registration_date' => ['required'],
            'expiration_date' => ['required'],
            'manufacturer_id' => ['required'],
            'type_id' => ['required'],
            'model_id' => ['required'],
            'status' => ['required']
        ];
    }
}
