<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index () {
        $jobs = Job::with('employer')->latest()->paginate();

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }
    public function create () {
        return view('jobs.create');
    }
    public function store () {
// Validation
request()->validate([
    'title' => ['required','min:3'],
    'salary' => ['required']
]);

// saving to database
Job::create([
    'title' => request('title'),
    'salary' => request('salary'),
    'employer_id' => 1,
]);

return redirect('/jobs');
    }
    public function show (Job $job) {
        return view('jobs.show', [
            'job' => $job
        ]);
    }
    public function edit (Job $job) {
        return view('jobs.edit', [
            'job' => $job
        ]);
    }
    public function update (Job $job) {
  // Validation
  request()->validate([
    'title' => ['required','min:3'],
    'salary' => ['required']
]);

$job->title = request('title');
$job->salary = request('salary');

// save
$job->save();
// redirect
return redirect('/jobs');
    }
    public function destroy (Job $job) {
        $job->delete();
        return redirect('/jobs');
    }
}
