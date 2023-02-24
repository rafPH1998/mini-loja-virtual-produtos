<x-app>
    <h1 class="text-2xl font-normal leading-normal mt-0 mb-2 text-gray-300">Você tem {{ $totalCountProduct }} produtos cadastrado no sistema.</h1>

    @if ($myProducts->isEmpty())
        <div class="w-full shadow-2xl sm:rounded-lg mt-3 bg-gray-900">
            <p class="px-8 py-8">
                Nenhum produto seu cadastrado em nosso sistema!
            </p>
        </div>        
    @else
        <table class="sm:rounded-lg w-5/6 mt-12 text-sm text-left 
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
                            @if ($product->quantity_inventory > 0)
                               <p class="text-green-500"> {{$product->quantity_inventory}}</p>
                            @else
                                <p class="inline-flex items-center
                                    px-3 py-0.5 rounded-full text-sm 
                                    font-medium 
                                    bg-red-100 text-red-800">
                                    <b>Sem estoque</b>
                                </p>
                            @endif
                        </td>
                        <td class="flex mt-3">
                            <a class="transition ease-in-out 
                                delay-150 hover:-translate-y-1 
                                hover:scale-110 duration-300" 
                                href="{{ route('products.comments', $product->id) }}">
                                <img class="w-5 h-5 mt-1" src="{{url('images/comment.png')}}" alt="">
                            </a>
                            <a class="transition ease-in-out 
                                delay-150 hover:-translate-y-1 
                                hover:scale-110 duration-300" 
                                href="{{ route('products.show', $product->id) }}">
                                <img class="w-6 h-6 ml-2" src="{{url('images/eye.png')}}" alt="">
                            </a>
                    
                            @can('update-product', $product)
                                <a class="transition ease-in-out 
                                    delay-150 hover:-translate-y-1 
                                    hover:scale-110 duration-300"
                                    href="{{ route('products.comments', $product->id) }}">
                                    <img class="w-5 h-5 ml-2" src="{{url('images/pencil.png')}}" alt="">
                                </a>
                            @endcan  
                            <form action="#" method="POST" 
                                class="transition ease-in-out 
                                delay-150 hover:-translate-y-1 
                                hover:scale-110 duration-300">
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

    <div id="paginate" class="w-5/6">
        <div class="py-4">
            {{ $myProducts->appends([
                'filter' => request()->get('filter')
              ])->links() }}
        </div>
    </div>
    <div class="h-64">
    </div>
    <div class="pb-40"></div>
</x-app>


