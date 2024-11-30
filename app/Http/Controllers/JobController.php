<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    public function index()
    {
        return Job::with('employer')->latest()->paginate(perPage: 3);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        Job::create([
            'title' => $request['title'],
            'salary' => $request['salary'],
            'employer_id' => 1,
        ]);

        return redirect('/jobs');
    }

    public function show(Job $job)
    {
        return $job;
    }

    public function update(Job $job)
    {
        Gate::authorize('edit-job', $job);

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect("/jobs");
    }

    public function destroy(Job $job)
    {

        Gate::authorize('edit-job', $job);

        $job->delete();

        return redirect("/jobs");
    }
}
