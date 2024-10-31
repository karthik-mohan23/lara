<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    //reference 'job_listings' table when using Job model to interact
    protected $table = 'job_listings';

    // tell laravel that these fields can only be mass assigned
    protected $fillable = ['title', 'salary'];
}
