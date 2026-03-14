<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingSession extends Model
{
    protected $table = 'teaching_sessions';
    protected $fillable = ['name', 'teacher_id'];
}
