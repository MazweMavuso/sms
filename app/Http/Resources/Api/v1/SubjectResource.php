<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'teacher_id' => $this->teacher_id,
            'title' => $this->title,
            'description' => $this->description,
            'credits' => $this->credits,
            'teacher' => new UserResource($this->whenLoaded('teacher')),
            'enrollments' => EnrollmentResource::collection($this->whenLoaded('enrollments')),
            'attendances' => AttendanceResource::collection($this->whenLoaded('attendances')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
