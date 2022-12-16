<div class="p-2 w-full">
    <div class="relative">
        <label for="{{ $name }}" 
        class="leading-7 text-sm text-white">{{ $label }}</label>
        <textarea
            id="{{ $id }}" name="{{ $name }}"
            class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-white 
            leading-tight focus:outline-none focus:shadow-outline" >
        </textarea>
    </div>
    <span id="{{ $msgError }}" class="text-red-500"></span>
</div>