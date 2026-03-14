<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeachingSessionController;
use App\Models\Attendance;
use App\Models\Sessions;
use App\Models\TeachingSession;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['attendances' => Attendance::all()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sessions', function () {
    return view('sessions', ['sessions' => TeachingSession::all()]);
})->middleware(['auth', 'verified', 'teacher'])->name('sessions');

Route::post('/sessions', [TeachingSessionController::class, 'store'])->name('sessions.store');

Route::get('/attendance/check/{encryptedId}', [AttendanceController::class, 'check'])
->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
