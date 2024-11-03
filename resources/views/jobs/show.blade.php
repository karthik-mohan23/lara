<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>
    <h1>Job {{ $job['title'] }}</h1>
    <p>This job pays {{ $job['salary'] }} per year.</p>
    <div class="py-4 flex items-center gap-3">
        <x-link-button href="/jobs/{{ $job['id'] }}/edit">Edit</x-link-button>
        <form action="/jobs/{{$job->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-400 rounded-md p-2">Delete</button>
        </form>
    </div>
</x-layout>