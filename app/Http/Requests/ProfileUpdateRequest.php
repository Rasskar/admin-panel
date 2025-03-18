<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user()->id)],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'roleId' => ['required', 'integer', 'exists:roles,id'],
            'firstName' => ['nullable', 'string', 'max:255'],
            'lastName' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'This email is already taken by another user.',

            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',

            'roleId.required' => 'User role is required.',
            'roleId.integer' => 'Role must be an integer.',
            'roleId.exists' => 'The selected role is invalid.',

            'firstName.string' => 'First name must be a string.',
            'firstName.max' => 'First name cannot be longer than 255 characters.',

            'lastName.string' => 'Last name must be a string.',
            'lastName.max' => 'Last name cannot be longer than 255 characters.',
        ];
    }
}
