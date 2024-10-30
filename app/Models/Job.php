<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //reference 'job_listings' table when using Job model to interact
    protected $table = 'job_listings';

    // tell laravel that these fields can only be mass assigned
    protected $fillable = ['title', 'salary'];
}
