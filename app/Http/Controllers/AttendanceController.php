<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\TeachingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use function Symfony\Component\Clock\now;

class AttendanceController extends Controller
{
    public function check($encryptedId){

        $decryptedId = Crypt::decryptString($encryptedId);

        $session = TeachingSession::find($decryptedId);

        if(empty($session)) return abort(404, 'Session Not Found');

        $alreadyAttended = Attendance::where('user_id', Auth::user()->id)
                                    ->whereDate('created_at', today())
                                    ->exists();


        if($alreadyAttended) return redirect()->route('dashboard')
        ->with('failed', 'You Already Attended');;

        Attendance::create([
            'user_id' => Auth::user()->id,
            'session_id' => $session->id,
            'student_name' => Auth::user()->name,
        ]);



        return redirect()->route('dashboard')
        ->with('success', 'Attendance recorded successfully!');
    }
}
