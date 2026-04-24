<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'role' => new RoleResource($this->whenLoaded('role')),
            'profile' => $this->mergeWhen($this->relationLoaded('teacherProfile') && $this->teacherProfile, [
                'teacher' => new TeacherProfileResource($this->teacherProfile),
            ]) ?: $this->mergeWhen($this->relationLoaded('studentProfile') && $this->studentProfile, [
                'student' => new StudentProfileResource($this->studentProfile),
            ]) ?: $this->mergeWhen($this->relationLoaded('parentProfile') && $this->parentProfile, [
                'parent' => new ParentProfileResource($this->parentProfile),
            ]) ?: $this->mergeWhen($this->relationLoaded('adminProfile') && $this->adminProfile, [
                'admin' => new AdminProfileResource($this->adminProfile),
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
