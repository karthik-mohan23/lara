<x-layout>
    <x-slot:heading>
        Sign in
    </x-slot:heading>
  
<form action="/login" method="POST">
    @csrf
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
     
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="col-span-full">
            <label for="salary" class="block text-sm/6 font-medium text-gray-900">Email</label>
            <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="email" name="email" id="email"  class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" placeholder="$50,000 USD" required :value="old('email')">
                </div>
            </div>
            
            @error('email')
            <p class="text-red-400 text-sm mt-3">
              {{ $message }}
            </p>
        @enderror
          </div>
        </div>
  
          <div class="col-span-full">
            <label for="salary" class="block text-sm/6 font-medium text-gray-900">Password</label>
            <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="password" name="password" id="password"  class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" placeholder="your password" required>
                </div>
            </div>
            
            @error('password')
            <p class="text-red-400 text-sm mt-3">
              {{ $message }}
            </p>
        @enderror
          </div>
      
        </div>
 
      </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <a href="/" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log in</button>
    </div>
    </div>
  </form>
  

</x-layout>