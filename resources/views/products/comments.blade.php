<x-app>
    <div class="text-gray-600 body-font">

        <h1 class="ml-3 text-white" style="font-size: 35px;">
            Comentarios e avaliações do produto: <b>{{ $product->name }}</b>
        </h1>
        <hr class="mt-5">

        <div id="preloader" class="ml-5 mt-2" style="display: none;">
            <img src="{{ url('images/spinner.svg') }}" style="width: 40px;">
        </div>

       <div id="formCheck" style="display: block;">
            @if (count($product->comments) > 0)
                <form action="#" method="GET">
                    <div class="flex items-center mt-5">
                        <input id="checkbox-all" name="filter" 
                            checked
                            onclick="allComments({{ $product->id }})"
                            type="checkbox" value="allComments" 
                            class="w-4 h-4 rounded-full text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 
                            dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checked-checkbox" class="ml-2 text-sm font-medium text-white">Todos os comentários</label>

                        <input id="checkbox-my" name="filter" type="checkbox" 
                            @if(request('filter') == 'myComments') checked @endif
                            onclick="myComments({{ $product->id }})"
                            value="myComments" 
                            class="w-4 h-4 ml-3 rounded-full text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 
                            dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checked-checkbox" class="ml-2 text-sm font-medium text-white">Meus comentários</label>
                    </div>
                </form>
            @endif
       </div>

       <div id="result">
            @forelse ($listComments as $comments)
                <div class="w-2/3 flex bg-gray-900 shadow-md rounded p-4 mt-10 shadow-2xl">
                    <div class="pl-3 text-center">
                        <div class="pl-3 text-center flex">
                            @if ($comments->user->avatar)
                                <img
                                    style="width:35px;"
                                    class="rounded-full"
                                    src="{{ url("storage/{$comments->user->avatar}") }}" 
                                >
                            @else
                                <img style="width:35px;" 
                                    src="{{ url('images/user.png') }}" 
                                    title="Perfil" 
                                />
                            @endif
                            <div class="flex">
                                @if (auth()->user()->id == $comments->user->id)
                                    <p class="ml-2 mt-2 text-white">
                                        Meu usuário
                                    </p>
                                @else
                                    <h2 id="name" class="ml-3 mt-2 text-white text-sm">
                                        {{ $comments->user->name }} 
                                    </h2>
                                @endif
                                <p class="ml-8 mt-2">
                                    Data postada: {{ $comments->created_at }} 
                                </p>
                            </div>
                        </div>
                        <div class="ml-4 flex flex-row text-white mt-6">
                            <p> – {{ $comments->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full shadow-2xl sm:rounded-lg mt-3 bg-gray-900">
                    <p class="px-8 py-8">
                        Nenhuma avaliação ou comentário para esse produto!
                    </p>
                </div>
            @endforelse
        </div>
        <div id="resultError" class="mt-5"></div>
        <div class="pb-40"></div>
        <div class="pb-20"></div>
    </div>
</x-app>















