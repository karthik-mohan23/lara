<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => [
            [
                'title' => 'Teacher',
                'salary' => '$10,000'
            ],
            [
                'title' => 'Programmer',
                'salary' => '$50,000'
            ],
            [
                'title' => 'Doctor',
                'salary' => '$40,000'
            ],
        ]
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    return view('job', [
        'jobId' => $id
    ]);
});


Route::get('/contact', function () {
    return view('contact');
});
