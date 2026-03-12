<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class AttendanceController extends Controller
{
    public function check(){
        $alreadyAttended = Attendance::where('user_id', Auth::user()->id)
                                    ->whereDate('created_at', today())
                                    ->exists();


        if($alreadyAttended) return redirect()->route('dashboard')
        ->with('failed', 'You Already Attended');;

        Attendance::create([
            'user_id' => Auth::user()->id,
            'student_name' => Auth::user()->name,
        ]);



        return redirect()->route('dashboard')
        ->with('success', 'Attendance recorded successfully!');
    }
}
