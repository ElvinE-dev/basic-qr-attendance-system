<?php

namespace App\Http\Controllers;

use App\Models\TeachingSession;
use Illuminate\Http\Request;

class TeachingSessionController extends Controller
{

    
    public function store(Request $request){
        if(auth()->user()->role !== 'teacher') return abort(403, 'Unauthorized Action');
        $validated = $request->validate([
            'name' => 'string|required|max:255'
        ]);

        TeachingSession::create([
            'name' => $request->name,
            'teacher_id' => auth()->user()->id
        ]);

        return redirect()->to(route('sessions'))->with('Session Created Successfully');
    }
}
