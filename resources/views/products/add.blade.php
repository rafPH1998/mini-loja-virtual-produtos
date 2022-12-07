@extends('template.app')

@section('title', 'Adicionar um produto novo')

@section('content')

    <div class="mx-auto overflow-hidden shadow-lg mb-2 bg-gray-900 border-4 rounded-lg md:w-3/6 sm:w-4/6 border-gray-400">
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-white">Adicionar produto</h1>
        </div>

        <form method="POST" class="px-10 py-10" action="{{ route('products.store') }}" enctype="multipart/form-data">
            <div class="flex flex-wrap">
                @csrf
                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-white">Nome do produto</label>
                        <input type="text" id="name" name="name" 
                                value="{{ old('name') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 
                                leading-tight focus:outline-none focus:shadow-outline 
                                @error('name') border-red-500 @enderror"
                        >
                    </div>
                    @error('name')
                        @foreach ($errors->messages()['name'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-white">Preço</label>
                        <input type="text" id="price" name="price"
                            value="{{ old('price') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline
                            @error('price') border-red-500 @enderror"/>
                            
                    </div>
                    @error('price')
                        @foreach ($errors->messages()['price'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-white">Estoque</label>
                        <input type="text" id="quantity_inventory" name="quantity_inventory"
                            value="{{ old('quantity_inventory') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline 
                            @error('quantity_inventory') border-red-500 @enderror">
                    </div>
                    @error('quantity_inventory')
                        @foreach ($errors->messages()['quantity_inventory'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="image" class="leading-7 text-sm text-white">Imagem do produto</label>
                        <input type="file" id="image" name="image"
                            {{-- value="{{ old('image') }}" --}}
                            class="shadow appearance-none border rounded w-full 
                            py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline 
                            @error('image') border-red-500 @enderror">
                    </div>
                    @error('image')
                        @foreach ($errors->messages()['image'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="quality" class="leading-7 text-sm text-white">Estado do produto</label>
                        <select id="quality" name="quality" 
                                class="shadow appearance-none border rounded w-full 
                                py-2 px-3 text-gray-700 
                                leading-tight focus:outline-none focus:shadow-outline bg-gray-50
                                @error('quality') border-red-500 @enderror"> 

                                <option value="">Selecione um estado do produto</option>
                                @foreach ($qualityStatus as $status)
                                    <option value="{{$status->name}}">
                                        {{ $status->value }}
                                    </option>
                                @endforeach                      
                        </select>
                    </div>
                    @error('quality')
                        @foreach ($errors->messages()['quality'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="type" class="leading-7 text-sm text-white">Categoria do produto</label>
                        <select id="type" name="type" 
                                class="shadow appearance-none border rounded w-full 
                                py-2 px-3 text-gray-700 
                                leading-tight focus:outline-none focus:shadow-outline bg-gray-50
                                @error('type') border-red-500 @enderror"> 
                                
                                <option value="">Selecione a categoria do produto</option>
                                @foreach ($type as $categorie)
                                    <option value="{{$categorie->name}}">
                                        {{ $categorie->value }}
                                    </option>
                                @endforeach                 
                        </select>
                    </div>
                    @error('type')
                        @foreach ($errors->messages()['type'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="name" 
                        class="leading-7 text-sm text-white">Descrição</label>
                        <textarea
                            id="description" name="description"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline 
                            @error('description') border-red-500 @enderror">
                            {{ old('description') }}
                        </textarea>
                    </div>
                    @error('description')
                        @foreach ($errors->messages()['description'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
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















