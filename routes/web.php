<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
// index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate();

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});
// create form
Route::get('/jobs/create', function () {
    return view('jobs.create');
});
// store 
Route::post('/jobs', function () {
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

});
// edit form
Route::get('/jobs/{id}/edit', function ($id) {
    return view('jobs.edit', [
        'job' => Job::find($id)
    ]);
});
// show
Route::get('/jobs/{id}', function ($id) {
    return view('jobs.show', [
        'job' => Job::find($id)
    ]);
});
// update
Route::patch('/jobs/{id}', function ($id) {
    // Validation
 request()->validate([
    'title' => ['required','min:3'],
    'salary' => ['required']
]);
// find item
$job = Job::findOrFail($id);
$job->title = request('title');
$job->salary = request('salary');

// save
$job->save();
// redirect
return redirect('/jobs');

});
// destroy
Route::delete('/jobs/{id}', function ($id) {
  Job::findOrFail($id)->delete();
  return redirect('/jobs');
});


Route::get('/contact', function () {
    return view('contact');
});
