<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

// Route::controller(JobController::class)->group(function () {

//     Route::get('/jobs', 'index');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}', 'show');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');

// });

Route::resource('jobs', JobController::class, [
    'except' => ['edit', 'create'],
    // 'only' => []
]);
