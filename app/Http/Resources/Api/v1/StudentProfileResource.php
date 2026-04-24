<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'grade' => $this->grade,
            'admission_no' => $this->admission_no,
            'parent_id' => $this->parent_id,
            'date_of_birth' => $this->date_of_birth,
        ];
    }
}
