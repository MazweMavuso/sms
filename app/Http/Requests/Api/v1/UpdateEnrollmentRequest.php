<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['sometimes', 'exists:users,id'],
            'subject_id' => ['sometimes', 'exists:subjects,id'],
            'enrolled_at' => ['sometimes', 'date'],
        ];
    }
}
