<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;

class JobController extends Controller
{
    public function index() {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        return view('jobs.index',['jobs'=> $jobs]);
    }
    public function show(Job $job) {
        return view('jobs.show', ['job'=>$job]);
    }
    public function create() {
        // dd('hello there');
        return view('jobs.create');
    }
    public function store() {
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
    public function edit(Job $job)
    {
        // if (Auth::user()->cannot('edit-job', $job)) {
        //     dd('failure');
        // }

        return view('jobs.edit', ['job'=>$job]);
    }
    public function update(Job $job) {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
        //authorize

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
        return redirect('/jobs/' . $job->id);
    }
    public function destroy(Job $job) {
        //authorize
        $job->delete();
        return redirect('/jobs');
    }
}
