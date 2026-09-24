<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillListMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'tutor_id',
        'skill_id',
        'skill_status_id',
        'skill_rating',
    ];
}
