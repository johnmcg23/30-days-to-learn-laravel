<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    //index() lists all resources 
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    //create() shows a form to create a new resource
    public function create()
    {
        return view('jobs.create');
    }

    //show() displays a single resource
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    //store() save a newly created resource
    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->queue(
            new JobPosted($job)
        );

        return redirect('/jobs');
    }

    //edit() show a form to edit an existing resource
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    //update() Save changes to an existing resource
    public function update(Job $job)
    {
        Gate::authorize('edit-job', $job);

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    //destroy() delete a resource
    public function destroy(Job $job)
    {
        Gate::authorize('edit-job', $job);

        $job->delete();

        return redirect('/jobs');
    }
}
