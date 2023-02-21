<x-app>

    <div class="ml-5">
        <a href="{{ route('products.create') }}" 
            class="text-blue-700 hover:text-white border
            border-blue-700 hover:bg-blue-800 focus:ring-4
            focus:outline-none focus:ring-blue-300 font-medium 
            rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 
            dark:border-blue-500 dark:text-blue-500
            dark:hover:text-white dark:hover:bg-blue-600
            dark:focus:ring-blue-800">
            Adicionar um produto
        </a>
    </div>

    <div class="ml-4">
        <x-form.search placeholder="Procure por um produto" />
    </div>

    @if (count($products) > 0)
        <div class="py-12 flex flex-row-reverse">
            <x-form.options id="price" name="price" label="Busque por preços">
                <option @if(request('status') == 'all') selected @endif value="all">Todos</option>
                <option @if(request('status') == 'cheap') selected @endif value="cheap">Trazer os 5 produtos mais baratos</option>
                <option @if(request('status') == 'expensive') selected @endif value="expensive">Trazer os 5 produtos mais caros</option>
                <option @if(request('status') == 'last_registered') selected @endif value="last_registered">Trazer os 5 últimos produtos cadastrados</option>
            </x-form.options>

            <x-form.options id="quality" name="quality" label="Busque por avaliação">
                <option @if(request('status') == 'all') selected @endif value="all">Todos</option>
                <option @if(request('status') == 'news') selected @endif value="news">Trazer os 5 últimos produtos novos</option>
                <option @if(request('status') == 'semi_news') selected @endif value="semi_news">Trazer os 5 últimos produtos semi novos</option>
                <option @if(request('status') == 'god') selected @endif value="god">Trazer os 5 últimos produtos bons</option>
                <option @if(request('status') == 'medium') selected @endif value="medium">Trazer os 5 últimos produtos médios</option>
            </x-form.options>
        </div>
    @endif

    
    <div id="p" class="grid grid-cols-4 gap-4">
        @forelse ($products as $product)
            <div class="shadow-2xl
                transition ease-in-out delay-150 bg-gray-700 hover:-translate-y-1 
                hover:scale-110 hover:bg-gray-900 duration-300
                rounded-lg ml-4 mt-5">
                <div class="p-4">
                    <div class="flex justify-between">
                        <p class="mb-3 font-normal text-white">
                            {{ $product->getFormattedName() }}
                            @if ($product->isRecent())
                                <img class="h-8 w-8" src="{{url('images/new.png')}}" alt="">
                            @endif
                        </p>
                        <div>
                            <span class="rounded py-1 px-3 text-xs 
                                font-bold {{ $product->quantity_inventory > 0 ? 'bg-green-400 ' : 'bg-red-400 '}}"> 
                                {{ $product->quantity_inventory > 0 ? 'Em estoque' : 'Sem estoque' }}
                            </span>
                        </div>
                    </div> 
                    @if ($product->user->id == auth()->user()->id)
                        <p class="text-green-500 text-xs">
                            (meu produto) 
                        </p>
                    @endif
                    <p class="mt-3 font-normal text-white">
                        $ {{ number_format($product->price , 2, ',', '.') }}
                    </p>

                    <p style="font-size: 12px;" class="mb-1 text-sm mt-2 text-white">
                        Criado em: {{ $product->date }}
                    </p>
                    @foreach ($qualityStatus as $status)
                        <p class="text-sm text-white">
                            {{ $product->quality === $status->name ? $status->value : '' }}
                        </p>
                    @endforeach 
                    <div class="mt-5">
                        <a href="{{ route('products.comments', $product->id) }}" 
                            class="font-medium text-blue-500 hover:underline">
                            Avaliações ({{ $product->comments->count() }})
                        </a>
                    </div>
                    <div class="flex justify-between">
                        <a href="{{ route('products.show', $product->id)}}"
                            class="mt-2 text-indigo-500 inline-flex items-center">Ver mais
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" 
                                stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        <form action="#" method="POST">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                            @if ($product->user->id !== auth()->user()->id)
                                <button onclick="likedPost(event, {{ auth()->user()->id }}, {{ $product->id }}, this)"
                                    class="focus:outline-none text-sm  border transition ease-in-out delay-150 hover:-translate-y-1  p-1 rounded-md 
                                    {{ !$product->hasLikedByUser(auth()->id()) ? 'text-green-500' : 'text-red-500' }}"
                                    >                
                                    @if ($product->hasLikedByUser(auth()->id()))
                                        descurtir
                                    @else
                                        curtir
                                    @endif
                                </button>         
                            @endif 
                        </form>
                       
                    </div>
                </div>
            </div>
        @empty
            <p class="ml-5 mt-5 text-white">
                Nenhum produto encontrado.
            </p>
        @endforelse
    </div>    

    <div id="posts" class="flex items-stretch drop-shadow-xl"></div>

    <div id="paginate">
        <div class="py-4">
            {{ $products->appends([
                'filter' => request()->get('filter')
              ])->links() }}
        </div>
    </div>
</x-app>

