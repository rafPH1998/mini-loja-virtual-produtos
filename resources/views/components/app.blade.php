<!doctype html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta
        http-equiv="X-UA-Compatible"
        content="ie=edge"
    >

    <title>Mini loja virtual</title>
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<header class="bg-gray-700">
    <div class="container mx-auto flex justify-between p-5 items-center">
        <div class="flex items-center">
            <a href="{{ route('products.index') }}" 
                class="flex title-font font-medium items-center text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" 
                    stroke-linejoin="round" stroke-width="2" 
                    class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-white text-xl">Minha loja</span>
            </a>
        </div>
        

        <div class="flex items-center">

            <a href="" class="cursor-pointer">
                <div class="relative inline-flex w-fit mr-6 mt-1">
                    <div class="absolute top-0 right-0 bottom-auto left-auto 
                        z-10 inline-block translate-x-2/4 -translate-y-1/2 
                        rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 
                        whitespace-nowrap rounded-full bg-red-700 py-1 
                        px-2.5 text-center align-baseline text-xs font-bold 
                        leading-none text-white"> 
                        {{auth()->user()->like->count()}}
                    </div>
                    <img
                        style="width:30px;"
                        src="{{ url('images/favorite.png') }}"
                        >
                </div>
            </a>
            
            <div class="relative h-10 w-10">
                @php
                    $avatar = auth()->user()->avatar;
                @endphp
                @if ($avatar)
                    <img
                        style="width:35px;"
                        class="rounded-full mt-2"
                        src="{{ url("storage/{$avatar}") }}" 
                    >
                    <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                @else
                    <img
                        class="h-full w-full rounded-full object-cover object-center"
                        src="{{ url('images/user01.svg') }}"
                        alt=""
                    />
                    <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                @endif
            </div>
        
            <div>
                <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider" 
                    class="text-white text-xs
                    focus:outline-none focus:ring-blue-300 font-medium rounded-lg 
                    px-4 py-2.5 text-center inline-flex items-center" type="button">Olá, {{ auth()->user()->name }} 
                    <svg class="w-4 h-4 ml-1" aria-hidden="true" 
                        fill="none" stroke="currentColor" 
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownDivider" 
                    class="z-10 absolute hidden bg-gray-800 divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div id="ul" class="py-1 text-xs text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDividerButton">
                        <a href="{{ route('profile.index') }}" class="ml-2">
                            <p class="text-white ml-3 flex">
                                <img
                                    class="h-6 w-6 rounded-full mr-1"
                                    src="{{ url('images/user01.svg') }}"
                                    alt=""
                                />
                                Minha conta
                            </p>
                        </a>
                        <a href="{{ route('products.myShoppings') }}" class="ml-2">
                            <p class="text-white ml-3 flex">
                                <img
                                    class="h-6 w-6 rounded-full mr-1"
                                    src="{{ url('images/cart.png') }}"
                                    alt=""
                                />
                                Minhas compras ({{auth()->user()->shopping->count()}})
                            </p>
                        </a>
                        <a href="{{ route('products.myProducts') }}" class="ml-2 no-underline" >
                            <p class="text-white ml-3 flex">
                                <img
                                    class="h-6 w-6 rounded-full mr-1"
                                    src="{{ url('images/shopping-cart.png') }}"
                                    alt=""
                                />
                                Meus produtos cadastrado no sistema
                            </p>
                        </a>
                        <form action="{{route('logout')}}" method="POST" class="ml-4 mt-3">
                            @csrf
                            <a href="{{route('logout')}}" 
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <p class="text-white flex">
                                    <img
                                        class="h-6 w-6 rounded-png mr-1 "
                                        src="{{ url('images/logout.png') }}"
                                        alt=""
                                    />
                                    Sair
                                </p>
                            </a>
                        </form>
                    </div>
                </div>
                <!-- Dropdown menu -->
           </div>
        </div>
    </div>
      
</header>
<body class="bg-gray-900" id="body">
    <div class="overlay"></div>
    
    <section class="text-gray-600 overflow-hidden">
        <div class="container px-5 py-10 mx-auto">
            {{ $slot }}
        </div>
    </section> 

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ url('js/products/addProduct.js') }}"></script>
    <script src="{{ url('js/products/buyProduct.js') }}"></script>
    <script src="{{ url('js/comments/commentProduct.js') }}"></script>
    <script src="{{ url('js/products/getFilters.js') }}"></script>
    <script src="{{ url('js/products/likeProduct.js') }}"></script>
    <script src="{{ url('js/products/modalDelete.js') }}"></script>
    <script src="{{ url('js/products/index.js') }}"></script>
    <script src="{{ url('js/products/getFiltersComments.js') }}"></script>
    <script src="{{ url('js/products/searchProduct.js') }}"></script>

</body>
</html> 


<script>
    let clicou = document.getElementById('dropdownDividerButton');
    let dropdown = document.getElementById('dropdownDivider');

    // adiciona um ouvinte de eventos de clique ao documento inteiro
    document.addEventListener("click", function(event) {
        // verifica se o alvo do clique não é o botão ou o próprio dropdown
        if (event.target !== clicou && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
            dropdown.classList.remove('block');
        }
    });

    // adiciona um ouvinte de eventos de clique ao botão
    clicou.addEventListener("click", function(){
        dropdown.classList.toggle('hidden');
        dropdown.classList.toggle('block');
    });
    
</script>

