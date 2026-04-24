<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
            'date' => $this->date,
            'status' => $this->status,
            'student' => new UserResource($this->whenLoaded('student')),
            'subject' => new SubjectResource($this->whenLoaded('subject')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
