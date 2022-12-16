@props([
    'id' => null,
    'label' => null,
    'type' => null,
    'name' => null,
    'msgError' => null,
])

<div class="p-2 @if($name == 'name') w-full @else w-1/2 @endif">
    <div class="relative">
        <label for="{{ $name }}" class="leading-7 text-sm text-white">
            {{ $label }}
        </label>
        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" 
                class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-white 
                leading-tight focus:outline-none focus:shadow-outline"
        >
        <span id="{{ $msgError }}" class="text-red-500"></span>
    </div>
</div>