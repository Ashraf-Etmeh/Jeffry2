<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TransaletJob;
use App\Models\Job;

Route::get('test', function() {
    $job = Job::first();
    TransaletJob::dispatch($job);
    return 'Done';
});

Route::view('/', 'home');

//index
Route::get('/jobs', [JobController::class, 'index']);
//show
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::middleware('auth')->group(function () {
    //create
    Route::get('/create', [JobController::class, 'create']);
    //store
    Route::post('/jobs', [JobController::class, 'store']);
    //edit
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->can('edit', 'job');
    //update
    Route::patch('/jobs/{job}', [JobController::class, 'update']);
    //delete
    Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
});

//Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
Route::view('/contact', 'contact');

