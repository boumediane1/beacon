<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVesselRequest extends FormRequest
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
            'registration_number' => ['required', 'min:3', Rule::unique('vessels')->ignore($this->vessel->id)],
            'beacon_id' => ['required'],
            'activity_id' => ['required'],
            'unit_type_id' => ['nullable'],
            'city_id' => ['required'],
            'port_id' => ['required'],
            'mmsi' => ['nullable', 'size:9']
        ];
    }
}
