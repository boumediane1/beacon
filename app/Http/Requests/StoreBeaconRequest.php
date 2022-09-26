<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class   StoreBeaconRequest extends FormRequest
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
            'uin' => ['required', 'size:15', 'unique:beacons'],
            'serial_number_manufacturer' => ['nullable', 'unique:beacons'],
            'serial_number_sar' => ['nullable', 'unique:beacons'],
            'registration_date' => ['required'],
            'expiration_date' => ['required'],
            'manufacturer_id' => ['nullable'],
            'type_id' => ['required'],
            'model_id' => ['nullable'],
            'registration_status_id' => ['required'],
            'status_id' => ['required']
        ];
    }

    public function attributes()
    {
        return [
            'uin' => 'Beacon HEX ID'
        ];
    }
}
