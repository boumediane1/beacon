<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'unique:users'],
            'email' => ['nullable', 'email', 'unique:users'],
            'phone_number' => ['nullable', 'unique:users'],
            'secondary_phone_number' => ['nullable', 'unique:users'],
            'country_id' => ['required'],
            'cin' => ['nullable', 'unique:users'],
            'address' => ['nullable', 'min:3', 'max:80'],
            'emergency_contact_name' => ['nullable'],
            'emergency_contact_phone_number' => ['nullable'],
            'secondary_emergency_contact_name' => ['nullable'],
            'secondary_emergency_contact_phone_number' => ['nullable']
        ];
    }
}
