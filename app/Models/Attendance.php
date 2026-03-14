<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['student_name', 'session_id', 'user_id'];

    // app/Models/Attendance.php

    public function teachingSession() 
    {
        // If this is here, Laravel might be trying to validate or link it
        return $this->belongsTo(TeachingSession::class, 'session_id'); 
    }

}
