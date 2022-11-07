@extends('template.app')

@section('title', 'Visualizar produto')

@section('content')
    
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
        <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/800x450">
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
            <p class="leading-relaxed mt-3">
                {{ $product->description }}
            </p>
            <div class="my-3">
                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                    <b>({{ $product->quantity_inventory }}) {{ $product->quantity_inventory > 0 ? 'Em estoque' : 'Estoque vazio' }}</b>
                </span>
            </div>
            <p class="mt-7">Autor do produto postado:</p>
            <div class="flex mt-3">
                <p class="mb-1 text-sm mt-7 dark:text-gray-700">
                    <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </p>
                <p class="mt-3 ml-2">
                    {{ $product->user->name }}
                </p>
           </div>
            <div class="flex border-t-2 border-gray-100 mt-6 pt-6">
                <span class="title-font font-medium text-2xl text-gray-900">
                    ${{ number_format($product->price , 2, ',', '.') }}
                </span>
            </div>
        </div>
    </div>
@endsection
















