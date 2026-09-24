<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntensivePlan extends Model {
    use HasFactory;
    
    protected $fillable = ['name', 'detail', 'no_of_class', 'rate'];
}
