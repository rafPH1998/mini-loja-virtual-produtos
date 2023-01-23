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
    <div class="container mx-auto flex justify-between items-center p-5 items-center">
        <div class="flex items-center">
            <a href="{{ route('products.index') }}" class="flex title-font font-medium items-center text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" 
                    stroke-linejoin="round" stroke-width="2" 
                    class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-white text-xl">Minha loja</span>
            </a>
        </div>
 
        <div class="flex items-center">
          
            <div class="flex items-center mr-2">
                <img class="rounded-full w-3 h-3" src="{{ url('images/online.png') }}" />
            </div>

            <a href="{{ route('profile.index') }}">
                @php
                    $avatar = auth()->user()->avatar;
                @endphp
                @if ($avatar)
                    <img
                        style="width:35px;"
                        class="rounded-full"
                        src="{{ url("storage/{$avatar}") }}" 
                    >
                @else
                    <img style="width:25px;" src="{{ url('images/user01.svg') }}" title="Perfil" />
                @endif
            </a>
        
            <div>
                <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider" 
                    class="text-white
                    focus:outline-none focus:ring-blue-300 font-medium rounded-lg 
                    text-sm px-4 py-2.5 text-center inline-flex items-center" type="button">Olá, {{ auth()->user()->name }} <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                <!-- Dropdown menu -->
                <div id="dropdownDivider" 
                    class="z-10 absolute hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div id="ul" class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDividerButton">
                        <a href="{{ route('products.myProducts') }}" class="ml-2">
                            <p class="text-blue-600 ml-3">Meu produtos</p>
                        </a>
                        <a href="{{ route('address.create') }}" class="ml-2">
                            <p class="text-blue-600 ml-3">Adicionar endereços</p>
                        </a>
                        <a href="{{ route('address.create') }}" class="ml-2">
                            <p class="text-blue-600 ml-3">Meus endereços</p>
                        </a>
                        <form action="{{route('logout')}}" method="POST" class="ml-3 mt-3">
                            @csrf
                            <a href="{{route('logout')}}" 
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <p class="text-blue-600">Sair</p>
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
{{--     <footer class="text-gray-600">
        <div class="border-t border-gray-200">
        </div>
        <div class="bg-gray-600 h-64">
            <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                <p class="text-white text-sm text-center sm:text-left">© 2020 Tailblocks —
                    <a href="https://twitter.com/knyttneve" class="text-gray-600 ml-1" target="_blank" 
                    rel="noopener noreferrer">@knyttneve</a>
                </p>

                <span class="inline-flex lg:ml-auto lg:mt-0 mt-6 w-full justify-center text-white md:justify-start md:w-auto">
                    <span >Rafael Belchior da Silva</span>
                    <a class="ml-3 text-white mt-1" target="_blank" href="https://www.instagram.com/rafaelbelchiorsilva/">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                        </svg>
                    </a>
                    <a class="ml-1 text-white mt-1" target="_blank" href="https://www.linkedin.com/in/rafael-belchior-9b03261a7/">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
    </footer> --}}

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ url('js/addProduct.js') }}"></script>
    <script src="{{ url('js/getFilters.js') }}"></script>
    <script src="{{ url('js/modalDelete.js') }}"></script>
</body>
</html>


<script>
    let clicou   = document.getElementById('dropdownDividerButton');
    let dropdown = document.getElementById("dropdownDivider")

    clicou.addEventListener("click", function(){
        dropdown.classList.toggle('hidden')
        dropdown.classList.toggle('block')
    })
  
</script>

