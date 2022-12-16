@props([
    'blue' => null,
    'id' => null,
])

<button id="{{ $id }}" 
    {{ $attributes->class([
        'text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none',
        'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800' => $blue,
    ]) }} >
    {{ $slot }}
</button>

