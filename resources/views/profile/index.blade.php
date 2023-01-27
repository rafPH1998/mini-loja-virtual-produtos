<x-app>
    <div class="overflow-hidden rounded-lg shadow-md m-5">
        <table class="w-full border-collapse bg-gray-900 text-left text-sm text-gray-500">
          <thead class="">
            <tr>
              <th scope="col" class="px-6 py-4 font-medium text-white">Name</th>
              <th scope="col" class="px-6 py-4 font-medium text-white">State</th>
              <th scope="col" class="px-6 py-4 font-medium text-white">Role</th>
              <th scope="col" class="px-6 py-4 font-medium text-white">Team</th>
              <th scope="col" class="px-6 py-4 font-medium text-white"></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            <tr>
              <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                <div class="relative h-10 w-10">
                  <img
                    class="h-full w-full rounded-full object-cover object-center"
                    src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    alt=""
                  />
                  <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                </div>
                <div class="text-sm">
                  <div class="font-medium text-gray-700">Steven Jobs</div>
                  <div class="text-gray-400">jobs@sailboatui.com</div>
                </div>
              </th>
              <td class="px-6 py-4">
                <span
                  class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
                >
                  <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                  Active
                </span>
              </td>
              <td class="px-6 py-4">Product Designer</td>
              <td class="px-6 py-4">
                <div class="flex gap-2">
                  <span
                    class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600"
                  >
                    Design
                  </span>
                  <span
                    class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600"
                  >
                    Product
                  </span>
                  <span
                    class="inline-flex items-center gap-1 rounded-full bg-violet-50 px-2 py-1 text-xs font-semibold text-violet-600"
                  >
                    Develop
                  </span>
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="flex justify-end gap-4">
                  <a x-data="{ tooltip: 'Delete' }" href="#">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-6 w-6"
                      x-tooltip="tooltip"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                      />
                    </svg>
                  </a>
                  <a x-data="{ tooltip: 'Edite' }" href="#">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="h-6 w-6"
                      x-tooltip="tooltip"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                      />
                    </svg>
                  </a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

























































    <div id="form-container" class="mx-auto overflow-hidden shadow-lg mb-2 shadow-2xl bg-gray-900 rounded-lg sm:w-4/6">        
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-white">Editar dados do meu perfil</h1>
        </div>

        <form method="POST" class="px-10" action="{{ route('profile.edit') }}" enctype="multipart/form-data">

            @if (Session::has('success'))
                <p class="text-green-500">
                    {{ Session::get('success') }}
                </p>
            @endif
            
            <div class="flex flex-wrap mt-2">
                @csrf
                @method("PUT")
                
                @if (isset($authUser->avatar))
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
                            class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-white
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
                            class="bg-gray-800 appearance-none rounded w-full 
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
                            class="bg-gray-800 appearance-none rounded w-full 
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















