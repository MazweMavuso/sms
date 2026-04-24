<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'subject' => $this->subject,
            'employee_no' => $this->employee_no,
            'department' => $this->department,
        ];
    }
}
