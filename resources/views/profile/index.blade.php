<x-app>
    <div id="form-container" class="mx-auto overflow-hidden shadow-lg mb-2 bg-gray-800 rounded-lg sm:w-4/6">        
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-white">Editar dados do meu perfil</h1>
        </div>

        <form method="POST" class="px-10" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            @if (Session::has('success'))
                <p class="text-green-500">
                    {{ Session::get('success') }}
                </p>
            @endif
            
            <div class="flex flex-wrap mt-2"> 
                @if ($authUser->avatar)
                    <div class="w-40 h-40">
                        <img class="w-full h-full rounded-full" src="{{ url("storage/{$authUser->avatar}") }}">
                    </div>
                @else
                    <div class="w-40 h-40 flex items-center text-center">
                        <img  class="w-full h-full rounded-full" src="{{ url('images/user01.svg') }}" title="Perfil" />
                        <p class="text-white ml-2">Foto</p>
                    </div>
                @endif
                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="avatar" class="leading-7 text-sm text-white">Foto</label>
                        <input type="file" id="avatar" name="avatar"
                            class="appearance-none border rounded w-full 
                            py-2 px-3 text-gray-700 
                            leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    @error('avatar')
                        @foreach ($errors->messages()['avatar'] as $error)
                            <span class="text-red-500 ml-3">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-full">
                    <div class="relative shadow-lg">
                        <label for="name" class="leading-7 text-sm text-white">Nome</label>
                        <input type="text" id="name" name="name" 
                            value="{{$authUser->name}}"
                            class="bg-gray-700 appearance-none rounded w-full py-2 px-3 text-white
                            leading-tight focus:outline-none focus:shadow-outline"
                        >
                    </div>
                    @error('name')
                        @foreach ($errors->messages()['name'] as $error)
                            <span class="text-red-500 ml-3">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="email" class="leading-7 text-sm text-white">E-mail</label>
                        <input type="email" id="email" name="email"
                            value="{{$authUser->email}}"
                            class="bg-gray-700 appearance-none rounded w-full py-2 px-3 text-white
                            leading-tight focus:outline-none focus:shadow-outline" >
                    </div>
                    @error('email')
                        @foreach ($errors->messages()['email'] as $error)
                            <span class="text-red-500 ml-3">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="password" class="leading-7 text-sm text-white">Alterar senha</label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-700 appearance-none rounded w-full 
                            py-2 px-3 text-white
                            leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                @error('password')
                    @foreach ($errors->messages()['password'] as $error)
                        <span class="text-red-500 ml-3">{{ $error }}</span>
                    @endforeach
                @enderror

                <div class="p-2 w-full">
                    <div class="relative">
                        <label for="password_confirm" class="leading-7 text-sm text-white">Confirmar senha</label>
                        <input type="password" id="password_confirm" name="password_confirm"
                            class="bg-gray-700 appearance-none rounded w-full 
                            py-2 px-3 text-white
                            leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    @if (Session::has('error_password'))
                        <span class="text-red-500">{{Session::get('error_password')}}</span>
                    @endif
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
</x-app>















