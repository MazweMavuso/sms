<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'employee_no',
        'department',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
