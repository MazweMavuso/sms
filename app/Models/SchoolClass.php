<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

// optional explicit import for clarity

// Teacher is in the same namespace, explicit import is optional and removed

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'class_number',
        'letter',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'school_class_id');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'school_class_subject', 'school_class_id', 'subject_id');
    }
}
