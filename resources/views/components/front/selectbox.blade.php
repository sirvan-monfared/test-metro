@props(['name', 'value', 'options'])
<div {{ $attributes->merge(['class' => '']) }}>
    <label for="{{ $name }}" class="inline-block mb-2 text-sm text-gray-600">{{ $slot }}</label>
    <select id="{{ $name }}" name="{{ $name }}"
            class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @foreach($options as $key => $title)
            <option value="{{ $key }}" @selected($key === $value)>{{ $title }}</option>
        @endforeach
    </select>
</div>
