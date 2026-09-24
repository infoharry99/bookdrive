<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'postcode',
        'mobile_number',
        'opt_in',
        'lessonstype',
        'transmission',
        'fasttrack',
        'spreadoutLesson',
        'fasttrackdriving',
        'bookedDrivingtest',
        'drivingtestDate',
        'lessonTime',
        
        'previous_experience',
    ];
}
