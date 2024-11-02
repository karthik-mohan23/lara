<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate();

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});
Route::post('/jobs', function () {
// Validation


Job::create([
    'title' => request('title'),
    'salary' => request('salary'),
    'employer_id' => 1,
]);

return redirect('/jobs');

});
Route::get('/jobs/{id}', function ($id) {
    return view('jobs.show', [
        'job' => Job::find($id)
    ]);
});


Route::get('/contact', function () {
    return view('contact');
});
