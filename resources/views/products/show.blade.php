@extends('template.app')

@section('title', 'Visualizar produto')

@section('content')

    <div class="lg:w-4/5 mx-auto flex flex-wrap shadow-2xl">
   
        <div class="xl:w-1/4 md:w-1/2 p-4">
            sem imagem
        </div>

        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0 ml-10">
            <h1 class="text-3xl title-font font-medium mb-1 text-white">{{ $product->name }}</h1>
            <hr/>
            <p class="leading-relaxed mt-5 text-white">
                <b>Descrição do produto: </b>
                <p class="text-gray-500">{{ $product->description }}</p>
            </p>
            <div class="my-3 mt-5 text-white">
                <b>Quantidade:</b>
               <p>
                    <p class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                        <b>({{ $product->quantity_inventory }}) {{ $product->quantity_inventory > 0 ? 'Em estoque' : 'Estoque vazio' }}</b>
                    </p>
               </p>
            </div>
            <div class="my-3 mt-5">
                <b class="text-white">Estado do produto:</b>
                @foreach ($qualityStatus as $status)
                    <p class="text-gray-500">
                        {{ $product->quality === $status->name ? $status->value : '' }}
                    </p>
                @endforeach    
            </div>
            <p class="mt-7 mt-5 text-white"><b>Autor do produto postado:</b></p>
            <div class="flex mt-3">
                <p class="mb-1 text-sm mt-7 dark:text-gray-700">
                    <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </p>
                <p class="mt-3 ml-2 text-gray-500">
                    {{ $product->user->name }}
                </p>
        </div>
        <div class="flex border-t-2 border-gray-100 mt-6 pt-6">
            <span class="title-font font-medium text-2xl text-white">
                ${{ number_format($product->price , 2, ',', '.') }}
            </span>
        </div>
        
        @can('product-users', $product)
            <form action="{{route('products.create_comment') }}" method="POST" class="mt-10">
                @csrf
                <x-alerts/>

                <input type="hidden" name="id" value="{{ $product->id }}">
                <textarea class="w-full px-5 
                    py-2 text-gray-700 bg-gray-200 focus:outline-none rounded" 
                    name="description" cols="30" rows="4" 
                    placeholder="O que achou do produto?"
                ></textarea>

                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                        focus:ring-blue-300 font-medium rounded-lg 
                        text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 
                        dark:hover:bg-blue-700 focus:outline-none 
                        dark:focus:ring-blue-800">
                        Criar comentário
                </button>
            </form> 
        @endcan
    </div>
@endsection
















