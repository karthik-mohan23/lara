<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>
    <div class="space-y-5">
        @foreach ($jobs as $job)
   <a href="/jobs/{{ $job['id'] }}">
    <div class="bg-white p-5 rounded-lg border-gray-500">
<div class="text-blue-500"> {{ $job->employer->name }}</div>
<p>
    {{ $job['title'] }} gets {{ $job['salary'] }} per year.
</p>
    </div>
</a>    
        @endforeach

        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>