<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role_id' => ['required', 'exists:roles,id'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],

            // Teacher fields
            'subject' => ['required_if:role_id,2', 'string', 'max:255'],
            'employee_no' => ['required_if:role_id,2', 'string', 'unique:teacher_profiles,employee_no'],
            'department' => ['nullable', 'string', 'max:255'],

            // Student fields
            'grade' => ['required_if:role_id,3', 'string', 'max:50'],
            'admission_no' => ['required_if:role_id,3', 'string', 'unique:student_profiles,admission_no'],
            'parent_id' => ['nullable', 'exists:users,id'],
            'date_of_birth' => ['required_if:role_id,3', 'date'],

            // Parent fields
            'occupation' => ['nullable', 'string', 'max:255'],

            // Admin fields
            'position' => ['required_if:role_id,1', 'string', 'max:255'],
            'access_level' => ['nullable', 'string', 'max:50'],
        ];
    }
}
