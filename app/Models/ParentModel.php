<?php

namespace App\Models;

use Database\Factories\ParentModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ParentModel extends Model
{
    /** @use HasFactory<ParentModelFactory> */
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'parent_student', 'parent_id', 'student_id');
    }
}
