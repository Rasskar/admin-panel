<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('passwordConfirmation')) {
            $this->merge([
                'newPassword_confirmation' => $this->input('passwordConfirmation'),
            ]);
        }
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'currentPassword' => ['required'],
            'newPassword' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed',
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'currentPassword.required' => 'Current password is required.',
            'newPassword.required' => 'New password is required.',
            'newPassword.min' => 'Password must be at least 8 characters.',
            'newPassword.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'newPassword.confirmed' => 'Password confirmation does not match.',
        ];
    }

    /**
     * @param $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $user = $this->user();

            if (!Hash::check($this->input('currentPassword'), $user->password)) {
                $validator->errors()->add('currentPassword', 'The current password you entered is incorrect.');
            }
        });
    }
}
