# Laravel Learning Notes

## Routes

Basic setup for a route:

```php
Route::get('/', function () {
    return view('welcome');
});
```

## Components

Components can be stored inside the components folder. Here’s an example of how to use a component.

Example: Layout Component
Inside components/layout.blade.php:

How to use this component ?

```
<x-layout>
    dynamic content here
</x-layout>
```

To embed dynamic content in layout.blade.php, use the {{ $slot }} variable:

Inside layout.blade.php

```
<body>
    <div>
        {{ $slot }}
    </div>
</body>
```

## Named Slots

Named slots allow you to insert multiple dynamic sections into a component.

Usage:

```
<x-layout>
    <x-slot:heading>
        Home
    </x-slot:heading>
    <h1>Hello from home page</h1>
</x-layout>
```

In layout.blade.php, include the slot like so:

```
<body>
    <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
    <div>
        {{ $slot }}
    </div>
</body>
```

## Passing Attributes to Components

To pass attributes to components, you can use $attributes.

Example: nav-link Component
Usage in your main Blade file:

```
<x-nav-link href="/">
    Home
</x-nav-link>
```

In the nav-link component:
nav-link.blade.php

```
<a {{ $attributes }}>{{ $slot }}</a>
```

## Passing props to Components

How to distinguish between props and attributes ?

-   attributes => HTML attributes like href, id, class.
-   props => anything that is not an attribute.

If we do not explicitly define props in component files then everything we pass to components will be treated as attributes.

How to define props?

In components file

```
@props(['active' => false])

<a  class="{{ $active ? "bg-gray-900 text-white " : "text-gray-300 hover:bg-gray-700 hover:text-white " }}rounded-md  px-3 py-2 text-sm font-medium " aria-current="{{ $active ? "page" : false }}" {{ $attributes }}>{{ $slot }}</a>
```

Here false is the default value

How to use this component ?

```
 <x-nav-link href="/"  :active="request()->is('/')">Home</x-nav-link>
```

When you prefix a prop with :(colon), it means the value you are providing to this prop should be treated as an expression rather than as a string.

## Passing data to view

```
Route::get('/', function () {
    return view('home', [
        'greeting' => 'laravel' //$greeting
    ]);
});
```

The second argument will be an array where each of the key will be extracted into variables once your view is loaded.
Here in the view you will have access to $greeting variable.

In the home view file

```
<x-layout>
    <x-slot:heading>
        Home
    </x-slot:heading>
    <h1>Hello from {{ $greeting }}</h1>
</x-layout>
```

## Route wildcards

```
Route::get('/jobs/{id}', function ($id) {
    return view('contact');
});
```

## To list all artisan commands

```
php artisan
```

## To create new table schema/migration file

```
php artisan make:migration
```

## Meet Eloquent

When you create Job model laravel thinks that you have a table called 'jobs' and tries to reference it.

To override this feature you can use

```
class Job extends Model
{
    //reference 'job_listings' table when using Job model to interact
    protected $table = 'job_listings';
}
```

| Model      | Table in DB  |
| ---------- | ------------ |
| Job        | jobs         |
| JobListing | job_listings |

## Artisan command to get help from a specific command

eg:

```
php artisan help make:model
```

## Factories

To add fake data

Command to create new factory file

```
php artisan make:factory -m=<NameOfTheModel(User)> JobFactory(nameOfTheFile)
```

How to create fake data?

```
php artisan tinker
```

```
App\Models\User::factory(10)->create();
```

How to create a particular state method ?
why?
To override the default values used to set the fake data

```
   public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'admin' => true,
        ]);
    }
```

How to run a particular state method ?

```
App\Models\User::factory()->admin()->create();
<!-- App\Models\User::factory()->callTheStateMethod()->create(); -->
```

## Relationships

How to add foreign key in a migration file ?

```
$table->unsignedBigInteger('employer_id')
<!-- $table->unsignedBigInteger('foreignTable_id') -->
```

or

```
$table->foreignIdFor(Employer::class)
<!-- $table->foreignIdFor(ModelName::class) -->
```

How to create fake data if there is a foreign key ?

```
JobFactory
 public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'employer_id' => Employer::factory(),
            'salary' => '$50,000 USD'
        ];
    }
```

So laravel knows okay I need to create a Employer factory and use its primary key here.

## Debugbar for Laravel

Installation

```
composer require barryvdh/laravel-debugbar --dev
```

## N+1 problem

It refers to database queries executed within a loop, rather than making a single query that loads all of the relevant data upfront.

To fix this add eager loading(To minimize sql queries(2)).

For eg:

```
$jobs = Job::with('employer)->get();
```

get all jobs with employer(relationship method) rather than

```
$jobs = Job::all();
```

Disable Lazy loading completely in your app.
Now we will get an error in our application if we try lazy loading.

navigate->app/Providers/AppServiceProvider

```
  public function boot(): void
    {
        Model::preventLazyLoading();
    }
```

boot method -> triggered after all of the project dependencies have been fully loaded.

## Pagination

```
  1) $jobs = Job::all()->paginate();
  2) $jobs = Job::all()->simplePaginate();
  3) $jobs = Job::all()->cursorPaginate(); //Performant one.

    return view('jobs', [
        'jobs' => $jobs
    ]);
```

At Frontend

```
 <div>
    {{ $jobs->links() }}
 </div>
```

## Forms

Accepting request

```
Route::post('/jobs', function () {
    dd(request()->all());

    dd(request('nameOfTheForm));
});
```

```
Route::post('/jobs', function () {
    dd(request()->all());

    dd(request('nameOfTheForm));
});
```

## Create

```
Model::create([
    'name1' => request('nameOfTheForm'),
    'name2' => request('nameOfTheForm'),
]);
```

## Read

```
$data =  Model::all();
```

## Read one

```
$data =  Model::find($id);
```

## Update

```
$job = Job::find($id);
$job = Job::findOrFail($id); //Better approach

$job->title = request('title');
$job->salary = request('salary');
$job->save();

  or

Model::update([
    'name1' => request('nameOfTheForm'),
    'name2' => request('nameOfTheForm'),
]);
```

## Delete

```
Job::findOrFail($id)->delete();
```

## Redirect

```
return redirect('/jobs');
return redirect('/jobs' . $job->id);
```

## Fillable($fillable)

Fields that can be mass assigned

```
 protected $fillable = ['title', 'salary'];
```

## Guarded($guarded)

Fields that should be guarded from being mass assigned

```
 protected $guarded = [];
```

[] -> you don't need to guard anything

## Sort Descending(created_at)

```
Job::all()->latest();
```

## Validation

In Laravel, you don't have to redirect user manually, instead Laravel will automatically redirect user to previous form(page just refreshes) with error message.

```
 request()->validate([
    'title' => ['required','min:3'],
    'salary' => ['required']
]);
```

### Display validation errors

```
  @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                    <li class="text-red-500 text-sm">{{ $error }}</li>
            @endforeach
         </ul>
  @endif
```

### Display validation error directly below a field

```
@error('nameOfTheField')
    <p class="text-red-400 text-sm">
        {{ $message }}
    </p>
@enderror
```

## Render just views

```
Route::view('/contact',contact(blade file name))
```

## Route list

```
php artisan route:list --except-vendor
```

### Route list

```
'password' => ['required', 'confirmed']
```

Laravel will automatically check if password and password_confirmation fields have the same value.

### Session Hijacking

The exploitation of a valid session token to gain access to a web server.

```
request()->session()->regenerate();
```
