<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,'.$userId],
            'password' => ['sometimes', 'confirmed', Password::defaults()],
            'role_id' => ['sometimes', 'exists:roles,id'],
            'phone' => ['sometimes', 'nullable', 'string', 'max:20'],
            'address' => ['sometimes', 'nullable', 'string', 'max:255'],

            // Teacher fields
            'subject' => ['sometimes', 'string', 'max:255'],
            'employee_no' => ['sometimes', 'string', 'unique:teacher_profiles,employee_no,NULL,id,user_id,!'.$userId],
            // Better unique check for profiles
            'department' => ['sometimes', 'nullable', 'string', 'max:255'],

            // Student fields
            'grade' => ['sometimes', 'string', 'max:50'],
            'admission_no' => ['sometimes', 'string', 'unique:student_profiles,admission_no,NULL,id,user_id,!'.$userId],
            'parent_id' => ['sometimes', 'nullable', 'exists:users,id'],
            'date_of_birth' => ['sometimes', 'date'],

            // Parent fields
            'occupation' => ['sometimes', 'nullable', 'string', 'max:255'],

            // Admin fields
            'position' => ['sometimes', 'string', 'max:255'],
            'access_level' => ['sometimes', 'nullable', 'string', 'max:50'],
        ];
    }
}
