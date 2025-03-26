<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user()->id)],
            'phone' => ['required','string'],
            'summary' => ['nullable', 'max:255'],
            'age' => ['nullable','integer'],
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'The full name field is required.',
            'profession.required' => 'The profession field is required.',
            'location.required' => 'The location field is required.',
            'phone.required' => 'The phone field is required.',
            'email.required' => 'The email field is required.',
            'age.integer' => 'The age field must be a number.',
        ];
    }
}
