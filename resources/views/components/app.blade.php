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
            <div class="relative h-10 w-10">
                <a href="{{ route('profile.index') }}">
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
                </a>
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
                    class="z-10 absolute hidden bg-gray-600 divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div id="ul" class="py-1 text-xs text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDividerButton">
                        <a href="{{ route('products.myShoppings') }}" class="ml-2">
                            <p class="text-white ml-3">Minhas compras</p>
                        </a>
                        <a href="{{ route('products.myProducts') }}" class="ml-2 no-underline" >
                            <p class="text-white ml-3">Meus produtos cadastrado no sistema</p>
                        </a>
                        <form action="{{route('logout')}}" method="POST" class="ml-3 mt-3">
                            @csrf
                            <a href="{{route('logout')}}" 
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <p class="text-white">Sair</p>
                            </a>
                        </form>
                    </div>
                </div>
                <!-- Dropdown menu -->
           </div>
        </div>
    </div>
      
</header>
<body class="bg-gray-800" id="body">
    <section class="text-gray-600 overflow-hidden">
        <div class="container px-5 py-10 mx-auto">
            {{ $slot }}
        </div>
    </section> 

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ url('js/addProduct.js') }}"></script>
    <script src="{{ url('js/getFilters.js') }}"></script>
    <script src="{{ url('js/modalDelete.js') }}"></script>
    <script src="{{ url('js/likeProduct.js') }}"></script>

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

