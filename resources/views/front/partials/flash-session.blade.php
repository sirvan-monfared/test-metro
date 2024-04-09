@if(session()->has('success'))
    <p class="w-full text-white bg-green-500 py-3 text-lg text-center rounded-md">{{ session('success') }}</p>
@endif
@if(session()->has('danger'))
    <p class="w-full text-white bg-red-600 py-3 text-lg text-center rounded-md">{{ session('danger') }}</p>
@endif
