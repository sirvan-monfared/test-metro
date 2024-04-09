@props(['name', 'value'])

<div {{ $attributes->merge(['class' => 'ui search focus mt-15 text-sm-right']) }}>
    <label class="inline-block mb-2 text-sm text-gray-600" for="name">{{ $slot }}</label>
    <input type="text" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        class="w-full bg-gray-100 outline-0 rounded-md border border-transparent focus:border focus:border-gray-300 focus:ring-0 focus:shadow-md hover:border hover:border-gray-300 hover:ring-0 hover:shadow-md">

    @error($name)
        <p class="text-sm text-rose-600">{{ $message }}</p>
    @enderror
</div>
