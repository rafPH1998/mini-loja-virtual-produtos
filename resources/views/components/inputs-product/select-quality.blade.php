@props([
    'qualityStatus' => $qualityStatus,
    'id' => null,
    'label' => null,
    'name' => null,
    'msgError' => null,
])

<div class="p-2 w-1/2">
    <div class="relative">
        <label for="{{ $name }}" class="leading-7 text-sm text-white">{{ $label }}</label>
        <select id="{{ $id }}" name="{{ $name }}" 
                class="bg-gray-800 appearance-none rounded w-full 
                py-2 px-3 text-white 
                leading-tight focus:outline-none focus:shadow-outline" > 

                <option value="">Selecione um estado do produto</option>
                @if ($qualityStatus)
                    @foreach ($qualityStatus as $status)
                        <option value="{{$status->name}}">
                            {{ $status->value }}
                        </option>
                    @endforeach 
                @endif                                    
        </select>
    </div>
    <span id="{{ $msgError }}" class="text-red-500"></span>
</div>
