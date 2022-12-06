<!doctype html>
<html lang="en">
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

    <title>@yield('title') - Mini loja virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="text-gray-600">
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
            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            
            <p class="ml-3 text-white">
                <b>Bem vindo</b>, {{ auth()->user()->name }}
            </p>

            <form action="{{route('logout')}}" method="POST" class="ml-9">
                @csrf
                <a href="{{route('logout')}}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <img style="width:25px;" src="{{ url('images/logout.svg') }}" title="Sair" />
                </a>
            </form>

            <a href="{{ route('products.index') }}" class="ml-2">
                <img style="width:25px;" src="{{ url('images/home.svg') }}" title="Home"/>
            </a>

            <a href="{{ route('products.myProducts') }}" class="ml-2">
                <img style="width:25px;" src="{{ url('images/cart.svg') }}" title="Meus produtos"/>
            </a>
        </div>
    </div>
      
</header>
<body class="bg-gray-800">
    <section class="text-gray-600 overflow-hidden">
        <div class="container px-5 py-10 mx-auto">
            @yield('content')
        </div>
    </section>
    <footer class="text-gray-600">
        <div class="border-t border-gray-200">
        </div>
        <div class="bg-gray-600 h-64">
            <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                <p class="text-white text-sm text-center sm:text-left">© 2020 Tailblocks —
                    <a href="https://twitter.com/knyttneve" class="text-gray-600 ml-1" target="_blank" rel="noopener noreferrer">@knyttneve</a>
                </p>

                <span class="inline-flex lg:ml-auto lg:mt-0 mt-6 w-full justify-center text-white md:justify-start md:w-auto">
                    <span >Rafael Belchior da Silva</span>
                    <a class="ml-3 text-white mt-1" target="_blank" href="https://www.instagram.com/rafaelbelchiorsilva/">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                        </svg>
                    </a>
                    <a class="ml-1 text-white mt-1" target="_blank" href="https://www.linkedin.com/in/rafael-belchior-9b03261a7/">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
    </footer>

    <script src="{{ url('js/script.js') }}"></script>
</body>
</html>

