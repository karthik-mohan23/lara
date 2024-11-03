<x-layout>
    <x-slot:heading>
        Edit Job : {{ $job->title }}
    </x-slot:heading>
  
<form action="/jobs/{{$job->id}}" method="POST">
    @csrf
    @method("PATCH")
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base/7 font-semibold text-gray-900">Update job</h2>
        <p class="mt-1 text-sm/6 text-gray-600">Just fill this form.</p>
  
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label fsalary" class="block text-sm/6 font-medium text-gray-900">Title</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" name="title" id="title"  class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" placeholder="Frontend Developer" value="{{$job->title}}" required>
              </div>
            </div>
            @error('title')
            <p class="text-red-400 text-sm mt-3">
              {{ $message }}
            </p>
        @enderror
          </div>
  
          <div class="col-span-full">
            <label for="salary" class="block text-sm/6 font-medium text-gray-900">Salary</label>
            <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" name="salary" id="salary"  class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" value="{{$job->salary}}" placeholder="$50,000 USD" required>
                </div>
            </div>
            
            @error('salary')
            <p class="text-red-400 text-sm mt-3">
              {{ $message }}
            </p>
        @enderror
          </div>

        </div>
 
  
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <a href="/jobs/{{$job->id}}" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
    </div>
    </div>
  </form>
  

</x-layout>