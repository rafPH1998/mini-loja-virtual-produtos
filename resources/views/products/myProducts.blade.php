@extends('template.app')

@section('title', 'Meus produtos')

@section('content')

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        #
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Imagem
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Nome Produto
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Valor
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Estoque
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($myProducts as $product )
                
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">
                            {{ $product->id }}
                        </td>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Sem imagem
                        </th>
                        <td class="py-4 px-6">
                            {{ $product->name }}
                        </td>
                        <td class="py-4 px-6">
                            $ {{ number_format($product->price , 2, ',', '.') }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $product->quantity_inventory > 0 ? $product->quantity_inventory : 'Sem estoque'}}
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('products.show', $product->id) }}" 
                                class="focus:outline-none text-white bg-yellow-400 
                                hover:bg-yellow-500 focus:ring-4 
                                focus:ring-yellow-300 font-medium rounded-lg 
                                text-xs px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                                Ver
                            </a>
                            @can('update-product', $product)
                                <a href="{{ route('products.edit', $product->id) }}" 
                                    class="focus:outline-none text-white bg-purple-700 
                                    hover:bg-purple-800 focus:ring-4 focus:ring-purple-300
                                    font-medium rounded-lg text-xs px-5 py-2.5 mb-2 
                                    dark:bg-purple-600 dark:hover:bg-purple-700 
                                    dark:focus:ring-purple-900">
                                    Editar
                                </a>
                                <a href="" 
                                    class="ml-2 focus:outline-none text-white bg-red-700 
                                    hover:bg-red-800 focus:ring-4 
                                    focus:ring-red-300 font-medium rounded-lg 
                                    text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 
                                    dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    Deletar
                                </a>
                            @endcan     

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <nav class="flex justify-between items-center pt-4" aria-label="Table navigation">
        
        <ul class="inline-flex items-center -space-x-px py-2.5 px-2.5">
            @if ($myProducts->currentPage() > 1)
                <li>
                    <a href="?page={{ $myProducts->currentPage() - 1 }}" class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white 
                        rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 
                        dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </li>
            @endif
            <li>
                <a href="#" aria-current="page" 
                    class="py-2 px-3 text-blue-600 bg-blue-50 border 
                    border-gray-300 hover:bg-blue-100 hover:text-blue-700 
                    dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                    {{ $myProducts->currentPage() }}
                </a>
            </li>
            @if ($myProducts->currentPage() < $myProducts->lastPage())
                <li>
                    <a href="?page={{ $myProducts->currentPage() + 1 }}" class="block py-2 px-3 leading-tight text-gray-500 bg-white 
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
@endsection

