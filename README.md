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

## Passing Data to Components

To pass data to components, you can use attributes.

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
