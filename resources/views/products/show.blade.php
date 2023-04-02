<x-app>    
    <div class="lg:col-span-8">
        <div class="divide-y divide-slate-100 overflow-hidden rounded-xl
            bg-gray-800 shadow-xl shadow-slate-300/10 
            dark:divide-slate-700 dark:bg-slate-700/50 
            dark:shadow-slate-900">
            <div class="flex space-x-2 px-3 pt-4 pb-2 dark:hover:bg-slate-700/25 sm:space-x-4 sm:px-6">
                <div class="h-12 w-12 flex-none">
                    <div class="aspect-w-1 aspect-h-1">
                        @if ($product->user->avatar)
                            <img
                                class="rounded-full w-12 h-12"
                                src="{{ url("storage/{$product->user->avatar}") }}" 
                            >
                        @else
                            <img class="rounded-full w-12 h-12" src="{{ url('images/user01.svg') }}" title="Perfil" />
                        @endif
                    </div>
                </div>
            <div class="grow space-y-2">

                <h4 class="mb-1 flex flex-col text-sm font-semibold sm:flex-row sm:items-center">
                    <span class="flex items-center space-x-1">
                        @if ($product->user->id == auth()->user()->id)
                            <p class="text-green-500">
                                (meu produto)
                            </p>
                        @else
                            <p class="text-white">
                                {{ $product->user->name }}
                            </p>
                        @endif
                        <svg class="hi-solid hi-badge-check inline-block h-5 w-5 text-sky-500" 
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" 
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 
                                3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 
                                1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066
                                0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 
                                0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 
                                3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 
                                0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 
                                0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" 
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </span>
                    <span class="flex items-center space-x-1">    
                        <span class="font-medium text-slate-500 ml-2">• {{$product->date}}</span>
                    </span>
                </h4>
                <div class="flex">
                    <a class="block transition hover:opacity-75 active:opacity-100" href="javascript:void(0)">
                    <div class="aspect-w-16 aspect-h-9">
                        <img class="rounded h-full" src="{{ url("storage/{$product->image}") }}" alt="Uploaded media 4">
                    </div>
                    </a>  
                    <div class="flex flex-col ml-10">
                        <h1 class="text-3xl title-font font-medium mb-1 text-white">{{ $product->name }}</h1>
                        <hr class="w-96"/>
                        <p class="leading-relaxed mt-4 text-white">
                            <b>Descrição do produto: </b>
                            <p class="text-gray-500 text-sm">{{ $product->description }}</p>
                        </p>
                        <p class="leading-relaxed mt-4 text-white flex">
                            <b>Avaliações do produto: </b>
                            <div class="flex">
                                <p class="text-blue-400 text-sm mt-0.5 mr-1">({{ $product->like->count()}})</p>
                                <img class="w-5 h-5" src="{{url('images/like.png')}}" alt="likes">
                            </div> 
                            @if ($product->like->count() > 0)
                                @if ($product->takeOneLike())
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="far fa-star text-gray-400 text-xs"></i>
                                @endif
                                @if ($product->takeTwoLike())
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="far fa-star text-gray-400 text-xs"></i>
                                @endif
                                @if ($product->takeThreeLike())
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="far fa-star text-gray-400 text-xs"></i>
                                @endif
                                @if ($product->takeFourLike())
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="far fa-star text-gray-400 text-xs"></i>
                                @endif
                                @if ($product->takeFiveLikeAbove())
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                @endif
                            @else 
                                <i class="far fa-star text-gray-400 text-xs"></i>
                            @endif   
                        </p>

                        <div class="my-3 mt-4 text-white">
                            <b>Quantidade:</b>
                            <div id="result_do_php" style="display: block;">
                                <p>
                                    <p class="inline-flex items-center
                                         px-3 py-0.5 rounded-full text-sm font-medium
                                         {{ $product->quantity_inventory > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}}">
                                         <b>({{ $product->quantity_inventory }}) {{ $product->quantity_inventory > 0 ? 'Em estoque' : 'Estoque vazio' }}</b>
                                     </p>
                                </p>
                            </div>
                            <div id="result_do_js" style="display: none;">
                                <p>
                                    <p class="inline-flex items-center
                                         px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                         <b id="result"></b>
                                     </p>
                                </p>
                            </div>
                        </div>
            
                        <div class="my-3 mt-4">
                            <b class="text-white">Estado do produto:</b>
                            @foreach ($qualityStatus as $status)
                                <p class="text-gray-500">
                                    {{ $product->quality === $status->name ? $status->value : '' }}
                                </p>
                            @endforeach    
                        </div>
                        
                        <b class="text-white">Preço:</b>
                        <span class="title-font font-medium text-2xl text-gray-500">
                            ${{ number_format($product->price , 2, ',', '.') }}
                        </span>
            
                        @can('product-users', $product)
                            <form action="#" method="POST" class="mt-5">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                                <input type="hidden" name="id" value="{{ $product->id }}" id="id">
                                <input type="hidden" name="quantity_inventory" value="{{ $product->quantity_inventory }}" id="quantity_inventory">
                
                                <button 
                                    id="submitButton"
                                    class="text-white bg-green-700 hover:bg-green-800 
                                    focus:ring-4 focus:ring-green-300 font-medium rounded-lg 
                                    text-sm px-4 py-2.5 mr-2 mb-2 dark:bg-green-600 
                                    dark:hover:bg-green-700 focus:outline-none 
                                    dark:focus:ring-green-800">
                                    @if ($product->shopping)
                                        Remover compra
                                    @else
                                        Comprar
                                    @endif
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('product-users', $product)
        <div 
            class="mb-4 rounded-xl bg-gray-800 px-3 py-4 mt-10
            shadow-slate-300/10 dark:bg-slate-700/50 dark:shadow-slate-900 sm:p-6">
            <form action="#" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="flex space-x-4">
                    <div class="h-12 w-12 flex-none">
                        <div class="aspect-w-1 aspect-h-1">
                            @php 
                                $avatar = auth()->user()->avatar; 
                            @endphp
                            @if ($avatar)
                                <img
                                    class="rounded-full w-12 h-12"
                                    src="{{ url("storage/{$avatar}") }}" 
                                >
                            @else
                                <img class="rounded-full w-12 h-12" src="{{ url('images/user01.svg') }}" title="Perfil" />
                            @endif
                        </div>
                    </div>
                    <div class="grow">
                        <textarea 
                            class="block min-h-[40px] w-full 
                            rounded border border-transparent text-white
                            bg-transparent p-0 placeholder:text-slate-400 
                            focus:outline-none" 
                            name="description" id="description" rows="2" 
                            placeholder="O que você achou do produto?"></textarea>
                        <hr class="my-3 border border-gray-300 border-0.25">

                        <div class="flex flex-col space-y-3 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                            <div class="space-x-2"></div>
                            <div class="flex flex-row-reverse">
                                <button 
                                    id="buyProduct"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                                    focus:ring-blue-300 font-medium rounded-lg 
                                    text-sm px-5 py-2 dark:bg-blue-600 
                                    dark:hover:bg-blue-700 focus:outline-none 
                                    dark:focus:ring-blue-800 mt-1">
                                    <svg id="loading-button" style="display: none;" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" 
                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                    </svg>
                                    Criar comentário
                                </button>        
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endcan
</x-app>












