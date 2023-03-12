<x-app>

    <div class="ml-5">
        <a href="{{ route('products.create') }}" 
            class="text-blue-700 hover:text-white border
            border-blue-700 hover:bg-blue-800 focus:ring-4
            focus:outline-none focus:ring-blue-300 font-medium 
            rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 
            dark:border-blue-500 dark:text-blue-500
            dark:hover:text-white dark:hover:bg-blue-600
            dark:focus:ring-blue-800
            transition duration-150 ease-out hover:ease-in">
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

            <x-form.options id="quality" name="quality" label="Busque por categoria">
                <option @if(request('status') == 'eletronicos') selected @endif value="eletronicos">eletronicos</option>
                <option @if(request('status') == 'livros') selected @endif value="livros">livros</option>
                <option @if(request('status') == 'jogos') selected @endif value="jogos">jogos</option>
                <option @if(request('status') == 'acessorios') selected @endif value="acessorios">acessorios</option>
                <option @if(request('status') == 'brinquedos') selected @endif value="brinquedos">brinquedos</option>
                <option @if(request('status') == 'roupas') selected @endif value="roupas">roupas</option>
                <option @if(request('status') == 'perfumaria') selected @endif value="perfumaria">perfumaria</option>
            </x-form.options>
        </div>
    @endif

  {{--   <form action="#" method="POST">
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
    </form> --}}


    <div id="posts" class="flex items-stretch drop-shadow-xl"></div>

    <div id="pagination" class="mt-5 ml-7" style="display: block;">
        <nav aria-label="Page navigation example">
            <ul class="inline-flex items-center -space-x-px">
                <li>
                    <a href="#" id="previous-page" 
                        class="py-2 px-2 ml-0 leading-tight text-gray-500
                        bg-white rounded-l-lg border border-gray-300 
                        hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800
                        dark:border-gray-700 dark:text-gray-400 text-xs
                        dark:hover:bg-gray-700 dark:hover:text-white">Anterior
                    </a>
                </li>
                <li id="resultLinks">
                  
                </li>            
                <li>
                    <a href="#" id="next-page" 
                        class="py-2 px-2 ml-0 leading-tight text-gray-500 
                        bg-white rounded-r-lg border border-gray-300 
                        hover:bg-gray-100 hover:text-gray-700 text-xs
                        dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 
                        dark:hover:bg-gray-700 dark:hover:text-white">Próximo
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</x-app>
