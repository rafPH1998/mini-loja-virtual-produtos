@extends('template.app')

@section('title', 'Adicionar um produto novo')

@section('content')
    
    <div id="form-container" class="mx-auto overflow-hidden shadow-lg mb-2 bg-gray-900 border-4 rounded-lg md:w-3/6 sm:w-4/6 border-gray-400">
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-white">Adicionar produto</h1>
        </div>

        <form method="POST" class="px-10 py-10" action="#" id="addForm" enctype="multipart/form-data">
            <div class="flex flex-wrap">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-white">Nome do produto</label>
                        <input type="text" id="name" name="name" 
                                class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-gray-700 
                                leading-tight focus:outline-none focus:shadow-outline"
                        >
                    </div>
                    <span id="nameErro" class="text-red-500"></span>
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-white">Preço</label>
                        <input type="text" id="price" name="price"
                            class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline" >
                            
                    </div>
                    <span id="priceErro" class="text-red-500"></span>
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-white">Estoque</label>
                        <input type="text" id="quantity_inventory" name="quantity_inventory"
                            class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline" >
                    </div>
                    <span id="inventoryErro" class="text-red-500"></span>
                </div>

                {{-- <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="image" class="leading-7 text-sm text-white">Imagem do produto</label>
                        <input type="file" id="image" name="image"
                            class="shadow appearance-none border rounded w-full 
                            py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <span id="imageErro" class="text-red-500"></span>
                </div> --}}

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="quality" class="leading-7 text-sm text-white">Estado do produto</label>
                        <select id="quality" name="quality" 
                                class="bg-gray-800 appearance-none rounded w-full 
                                py-2 px-3 text-white 
                                leading-tight focus:outline-none focus:shadow-outline" > 

                                <option value="">Selecione um estado do produto</option>
                                @foreach ($qualityStatus as $status)
                                    <option value="{{$status->name}}">
                                        {{ $status->value }}
                                    </option>
                                @endforeach                      
                        </select>
                    </div>
                    <span id="qualityErro" class="text-red-500"></span>
                </div>

                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="type" class="leading-7 text-sm text-white">Categoria do produto</label>
                        <select id="type" name="type" 
                                class="bg-gray-800 appearance-none rounded w-full 
                                py-2 px-3 text-white
                                leading-tight focus:outline-none focus:shadow-outline" > 
                                
                                <option value="">Selecione a categoria do produto</option>
                                @foreach ($type as $categorie)
                                    <option value="{{$categorie->name}}">
                                        {{ $categorie->value }}
                                    </option>
                                @endforeach                 
                        </select>
                    </div>
                    <span id="typeErro" class="text-red-500"></span>
                </div>

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="name" 
                        class="leading-7 text-sm text-white">Descrição</label>
                        <textarea
                            id="description" name="description"
                            class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline" >
                    
                        </textarea>
                    </div>
                    <span id="descErro" class="text-red-500"></span>
                </div>

                <div class="p-2 w-full">
                    <button id="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
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















