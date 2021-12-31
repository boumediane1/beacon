<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'min:3', Rule::unique('users')->ignore($this->user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'phone_number' => ['required', Rule::unique('users')->ignore($this->user->id), 'digits:10'],
            'secondary_phone_number' => ['nullable', Rule::unique('users')->ignore($this->user->id), 'digits:10'],
            'address' => ['nullable', 'min:3', 'max:80']
        ];
    }
}
