@extends('template.app')

@section('title', 'Adicionar um produto novo')

@section('content')
    @include('components-alerts/alerts')

    <div class="lg:w-2/4 w-full mx-auto overflow-auto shadow-2xl rounded-md">
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-gray-900">Adicionar produto</h1>
        </div>
    
        <form method="POST" class="px-10 py-10" action="{{ route('products.store') }}">
            <div class="flex flex-wrap">
                @csrf
                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600">Nome do produto</label>
                        <input type="text" id="name" name="name" 
                                value="{{ old('name') }}" 
                                class="w-full bg-gray-100 bg-opacity-50 
                                rounded border border-gray-300 focus:border-indigo-500 
                                focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base 
                                outline-none text-gray-700 py-1 px-3 leading-8 
                                transition-colors duration-200 ease-in-out">
                    </div>
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600">Preço</label>
                        <input type="text" id="price" name="price"
                            value="{{ old('price') }}"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border 
                            border-gray-300 focus:border-indigo-500 focus:bg-white 
                            focus:ring-2 focus:ring-indigo-200 text-base outline-none 
                            text-gray-700 py-1 px-3 leading-8 transition-colors 
                            duration-200 ease-in-out" />
                    </div>
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600">Estoque</label>
                        <input type="text" id="quantity_inventory" name="quantity_inventory"
                            value="{{ old('quantity_inventory') }}"
                            class="w-full bg-gray-100 bg-opacity-50 rounded 
                            border border-gray-300 focus:border-indigo-500 
                            focus:bg-white focus:ring-2 focus:ring-indigo-200 
                            text-base outline-none text-gray-700 py-1 px-3 
                            leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600">Imagem de capa</label>
                        <input type="file" id="image" name="image"
                            value="{{ old('image') }}"
                            class="w-full bg-gray-100 bg-opacity-50 
                            rounded border border-gray-300 
                            focus:border-indigo-500 focus:bg-white 
                            focus:ring-2 focus:ring-indigo-200 text-base 
                            outline-none text-gray-700 py-1 px-3 leading-8 
                            transition-colors duration-200 ease-in-out" />
                    </div>
                </div>

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="name" 
                        class="leading-7 text-sm text-gray-600">Descrição</label>
                        <textarea
                            id="description" name="description"
                            class="w-full bg-gray-100 bg-opacity-50 
                            rounded border border-gray-300 
                            focus:border-indigo-500 focus:bg-white 
                            focus:ring-2 focus:ring-indigo-200 
                            text-base outline-none text-gray-700 
                            py-1 px-3 leading-8 transition-colors 
                            duration-200 ease-in-out">
                            {{ old('description') }}
                        </textarea>
                    </div>
                </div>

                <div class="p-2 w-full">
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                            focus:ring-blue-300 font-medium rounded-lg 
                            text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 
                            dark:hover:bg-blue-700 focus:outline-none 
                            dark:focus:ring-blue-800">
                            Adicionar
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection















