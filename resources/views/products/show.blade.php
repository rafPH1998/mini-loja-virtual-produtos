@extends('template.app')

@section('title', 'Visualizar produto')

@section('content')
    
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
        <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/800x450">
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
            <p class="leading-relaxed">
                {{ $product->description }}
            </p>
            <div class="my-3">
                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                    <b>({{ $product->quantity_inventory }}) {{ $product->quantity_inventory > 0 ? 'Em estoque' : 'Estoque vazio' }}</b>
                </span>
            </div>
            <div class="flex border-t-2 border-gray-100 mt-6 pt-6">
                <span class="title-font font-medium text-2xl text-gray-900">${{ number_format($product->price , 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
@endsection
















