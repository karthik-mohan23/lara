<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>
    <ul>
        @foreach ($jobs as $job)
   <li>{{ $job['title'] }} gets {{ $job['salary'] }} per year.</li>     
        @endforeach
    </ul>
</x-layout>