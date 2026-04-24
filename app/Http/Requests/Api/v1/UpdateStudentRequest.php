<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'unique:students,email,'.$this->route('student')],
            'phone' => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['sometimes', 'date'],
        ];
    }
}
