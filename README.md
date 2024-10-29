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
