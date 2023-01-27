<x-app>
    <x-modal />

    @if (count($myProducts) == 0)
        <div class="w-full shadow-2xl sm:rounded-lg mt-3 bg-gray-900">
            <p class="px-8 py-8">
                Nenhum produto seu cadastrado em nosso sistema!
            </p>
        </div>        
    @else
        <table class="sm:rounded-lg w-5/6 text-sm text-left 
                text-gray-500 dark:text-gray-400 shadow-2xl 
                bg-gray-900">
            <thead class="text-xs text-white uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        #
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
                    <th>
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($myProducts as $product )    
                    <tr class="hover:bg-gray-700">
                        <td class="py-4 px-6">
                            {{ $product->id }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $product->name }}
                        </td>
                        <td class="py-4 px-6">
                            $ {{ number_format($product->price , 2, ',', '.') }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $product->quantity_inventory > 0 ? $product->quantity_inventory : 'Sem estoque'}}
                        </td>
                        <td class="flex mt-3">
                            <a href="{{ route('products.comments', $product->id) }}">
                                <img class="w-5 h-5 mt-1" src="{{url('images/comment.png')}}" alt="">
                            </a>
                            <a href="{{ route('products.show', $product->id) }}">
                                <img class="w-6 h-6 ml-2" src="{{url('images/eye.png')}}" alt="">
                            </a>
                    
                            @can('update-product', $product)
                                <a href="{{ route('products.comments', $product->id) }}">
                                    <img class="w-5 h-5 ml-2" src="{{url('images/pencil.png')}}" alt="">
                                </a>
                            @endcan  
                            <form action="#" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                                <a href="#" onclick="showModal({{$product->id}})">
                                    <img class="w-5 h-5 ml-2" src="{{url('images/trash.png')}}" alt="">
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($myProducts->total() > 4)
        <nav class="flex justify-between items-center pt-4" aria-label="Table navigation">
            <ul class="inline-flex items-center -space-x-px py-2.5 px-2.5">
                @if ($myProducts->currentPage() > 1)
                    <li>
                        <a href="?page={{ $myProducts->currentPage() - 1 }}" 
                            class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white 
                            rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 
                            dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" 
                                    xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" 
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" 
                                    clip-rule="evenodd">
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
                        {{ $myProducts->currentPage() }}
                    </a>
                </li>
                @if ($myProducts->currentPage() < $myProducts->lastPage())
                    <li>
                        <a href="?page={{ $myProducts->currentPage() + 1 }}" 
                            class="block py-2 px-3 leading-tight text-gray-500 bg-white 
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
    <div class="h-64">
    </div>
    <div class="pb-40"></div>
</x-app>


