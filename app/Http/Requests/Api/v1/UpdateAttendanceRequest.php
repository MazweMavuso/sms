<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
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
            'date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'in:present,absent,late'],
        ];
    }
}
