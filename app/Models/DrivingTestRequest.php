<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrivingTestRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
         'center1',
          'center2', 
          'center3',
        'email',
        'test_centres',
        'earliest_date',
        'latest_date',
        'license_number',
        'theory_number'
    ];
}
