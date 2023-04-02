@props([
    'id'    => null,
    'label' => null,
    'name'  => null, 
])

<form action="#" method="GET" name="formSelect" class="ml-3">
    <div class="relative">
        <label for="{{ $name }}" class="leading-7 text-sm text-white">{{ $label }}</label>
        <select id="{{ $id }}" name="status" 
                onchange="statusFilter(this)"
                class="bg-gray-300 border border-gray-300 text-gray-900
                text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-48
                p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                dark:focus:ring-blue-500 dark:focus:border-blue-500">
                {{ $slot }}
        </select>
    </div>
</form>