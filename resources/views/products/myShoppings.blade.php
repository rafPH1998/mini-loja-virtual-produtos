<x-app>

    <h1 class="text-2xl font-normal leading-normal mt-0 mb-2 text-gray-300">Tabela das minhas compras</h1>

    <x-form.search placeholder="Procure por uma compra" />

    @if ($myShoppings->isEmpty())
        <div class="w-full shadow-2xl sm:rounded-lg mt-3 bg-gray-900">
            <p class="px-8 py-8">
                Você não comprou nenhum produto!
            </p>
        </div>        
    @else
        <table class="sm:rounded-lg w-5/6 mt-3 text-sm text-left 
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
                    <th>
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($myShoppings as $shopping)    
                    <tr class="hover:bg-gray-700">
                        <td class="py-4 px-6">
                            {{ $shopping->id }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $shopping->product->name }}
                        </td>
                        <td class="py-4 px-6">
                            $ {{ number_format($shopping->product->price , 2, ',', '.') }}
                        </td>
                        <td>
                            <form action="#" method="POST">
                                @method('DELETE')
                                @csrf
                                <a href="#" class="text-red-600" onclick="showModal({{$shopping->id}})">
                                    Deixar de comprar
                                </a>
                            </form>
                        </td>
                    </tr>
                @empty
                    <p class="ml-5 mt-5 text-white">
                        Nenhuma compra sua encontrada!
                    </p>
                @endforelse
            </tbody>
        </table>
    @endif

    <div id="paginate">
        <div class="py-4">
            {{ $myShoppings->appends([
                'filter' => request()->get('filter')
              ])->links() }}
        </div>
    </div>
    <div class="h-64">
    </div>
    <div class="pb-40"></div>
</x-app>


