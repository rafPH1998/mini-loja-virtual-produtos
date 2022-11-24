@extends('template.app')

@section('title', 'Listagem de produtos')

@section('content')

    <div class="mb-5 ml-5">
        <a href="{{ route('products.create') }}" 
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
            focus:ring-blue-300 font-medium rounded-lg 
            text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600  
            dark:hover:bg-blue-700 focus:outline-none 
            dark:focus:ring-blue-800">
            Adicionar
        </a>
    </div>

    <div class="ml-5 mt-5 flex">
        <div class="md:flex-nowrap flex-wrap justify-center md:justify-start">
            <form method="GET" action="#" class="flex items-center">   
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" 
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817
                                4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd">
                            </path>
                        </svg>
                    </div>
                    <input type="text" name="filter"
                            class="bg-gray-50 border border-gray-300 
                            text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                            focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 
                            dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                            dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Procure por um produto"
                    >
                </div>
                <button type="submit" 
                    class="p-2.5 text-sm font-medium text-white 
                    bg-blue-700 rounded-r-lg border border-blue-700 
                    hover:bg-blue-800 focus:ring-4 focus:outline-none 
                    focus:ring-blue-300 dark:bg-blue-600 
                    dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" 
                        stroke="currentColor" viewBox="0 0 24 24" 
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>
        @if (count($products) > 0)
            <form action="#" method="GET" name="formSelect" class="ml-5">
                <div class="max-w-2xl flex">
                    <select id="status" name="status" 
                            onchange="statusFilter(this)"
                            class="bg-gray-50 border border-gray-300 text-gray-900
                            text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full
                            p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                            dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option @if(request('status') == 'all') selected @endif value="all">Todos</option>
                            <option @if(request('status') == 'cheap') selected @endif value="cheap">Trazer os 3 produtos mais baratos</option>
                            <option @if(request('status') == 'expensive') selected @endif value="expensive">Trazer os 3 produtos mais caros</option>
                            <option @if(request('status') == 'last_registered') selected @endif value="last_registered">Trazer os 3 últimos produtos cadastrados</option>
                    </select>
                </div>
            </form>
        @endif
    </div>
    
    <div id="p" class="flex items-stretch drop-shadow-xl">
        @forelse ($products as $product)
            <div class="w-96 bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700 ml-4 mt-5">
                <a href="#">
                    <img class="rounded-t-lg w-full h-80" src="{{ url("storage/{$product->image}") }}" alt="{{ $product->name }}" />
                </a>
                <div class="p-5" >
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        <b>{{ $product->name }}</b>
                    </p>
                    @foreach ($qualityStatus as $status)
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ $product->quality === $status->name ? $status->value : '' }}
                         </p>
                    @endforeach    
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        $ {{ number_format($product->price , 2, ',', '.') }}
                    </p>
                    <p style="font-size: 12px;" class="mb-1 text-sm mt-2 dark:text-gray-400">
                        Criado em: {{ $product->created_at }}
                    </p>

                    <div class="mt-5">
                        <a href="{{ route('products.comments', $product->id) }}" 
                            class="font-medium text-blue-600 text-blue-500 hover:underline">
                            Avaliações ({{ $product->comments->count() }})
                        </a>
                    </div>
                   
                    <a href="{{ route('products.show', $product->id) }}" class="mt-5 text-indigo-500 inline-flex items-center">Ver mais
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <p class="ml-5 mt-5 mt-5">
                Nenhum produto encontrado.
            </p>
        @endforelse
    </div>

    <div id="posts" class="flex items-stretch drop-shadow-xl"></div>

    <div id="paginate">
        @if ($products->total() > 4)
            <nav class="flex justify-between items-center pt-4" aria-label="Table navigation">
                <ul class="inline-flex items-center -space-x-px py-2.5 px-2.5">
                    @if ($products->currentPage() > 1)
                        <li>
                            <a href="?page={{ $products->currentPage() - 1 }}" class="block py-2 px-3 ml-0 
                                leading-tight text-gray-500 bg-white 
                                rounded-l-lg border border-gray-300 hover:bg-gray-100 
                                hover:text-gray-700 dark:bg-gray-800 
                                dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 
                                dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" 
                                    fill="currentColor" viewBox="0 0 20 20" 
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" 
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 
                                        1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="#" aria-current="page" 
                            class="py-2 px-3 text-blue-600 bg-blue-50 border 
                            border-gray-300 hover:bg-blue-100 hover:text-blue-700 
                            dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                            {{ $products->currentPage() }}
                        </a>
                    </li>
                    @if ($products->currentPage() < $products->lastPage())
                        <li>
                            <a href="?page={{ $products->currentPage() + 1 }}" class="block py-2 px-3 
                                leading-tight text-gray-500 bg-white 
                                rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 
                                dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 
                                dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" 
                                        xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" 
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 
                                        1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif
    </div>
@endsection

