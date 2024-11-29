<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/jobs', function () {
    return Job::with('employer')->get();
});

Route::get('/jobs/paginate', function () {
    return Job::with('employer')->latest()->paginate(perPage: 3);
});

Route::get('/jobs/{id}', function ($id) {
    return Job::find($id);
});

Route::post('/jobs', function () {

    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});

Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect("/jobs");
});

Route::delete('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id);
    $job->delete();
    
    return redirect("/jobs");
});
