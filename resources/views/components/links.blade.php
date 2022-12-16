@props([
    'href' => $href,
    'blue' => null,
    'yellow' => null,
    'green' => null,
    'purple' => null,
    'red' => null,
])

<a href="{{ $href }}" 
    {{ $attributes->class([
        'focus:outline-none text-white ml-2 focus:ring-4 font-medium rounded-lg text-xs px-5 py-2.5 mb-2',
        'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800' => $blue,
        'bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-900' => $yellow,
        'bg-green-700 hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900' => $green,
        'bg-purple-700 hover:bg-purple-800 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900' => $purple,
        'bg-red-700 hover:bg-red-800 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800' => $red,
    ]) }} >
    {{ $slot }}
</a>  






