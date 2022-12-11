@extends('template.app')

@section('title', 'Editar dados do meu perfil')

@section('content')
    
    <div id="form-container" class="mx-auto overflow-hidden shadow-lg mb-2 shadow-2xl bg-gray-900 rounded-lg  sm:w-4/6">
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-white">Editar dados do meu perfil</h1>
        </div>

        <form method="POST" class="px-10 py-10" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
            <div class="flex flex-wrap">
                @csrf
                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="image" class="leading-7 text-sm text-white">Imagem</label>
                        <input type="file" id="image" name="image"
                            class="appearance-none border rounded w-full 
                            py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <div class="p-2 w-full">
                    <div class="relative shadow-lg">
                        <label for="name" class="leading-7 text-sm text-white">Nome</label>
                        <input type="text" id="name" name="name" 
                            value="{{$authUser->name}}"
                            class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-white
                            leading-tight focus:outline-none focus:shadow-outline"
                        >
                    </div>
                    <span id="nameErro" class="text-red-500"></span>
                </div>

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="email" class="leading-7 text-sm text-white">E-mail</label>
                        <input type="email" id="email" name="email"
                            value="{{$authUser->email}}"
                            class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-white
                            leading-tight focus:outline-none focus:shadow-outline" >
                    </div>
                </div>

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="password" class="leading-7 text-sm text-white">Alterar senha</label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-800 appearance-none rounded w-full 
                            py-2 px-3 text-white
                            leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="password_confirm" class="leading-7 text-sm text-white">Confirmar senha</label>
                        <input type="password_confirm" id="password_confirm" name="password_confirm"
                            class="bg-gray-800 appearance-none rounded w-full 
                            py-2 px-3 text-white
                            leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <div class="p-2 w-full">
                    <button id="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 
                            focus:ring-red-300 font-medium rounded-lg 
                            text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 
                            dark:hover:bg-red-700 focus:outline-none 
                            dark:focus:ring-red-800">
                            Alterar
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection















