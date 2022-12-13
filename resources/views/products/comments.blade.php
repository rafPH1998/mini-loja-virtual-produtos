@extends('template.app')

@section('title', "Comentário do produto")

@section('content')

    <div class="text-gray-600 body-font">

        <h1 class="ml-3 text-white" style="font-size: 35px;">
            Comentarios e avaliações do produto: <b>{{ $product->name }}</b>
        </h1>
        <hr class="mt-5">

       <form action="">
            <div class="flex items-center mt-5 ml-3">
                <input id="checked-checkbox" type="checkbox" value="" 
                    class="w-7 h-7 rounded-full text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 
                    dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ml-2 text-sm font-medium text-white">Todos os comentários</label>

                <input id="checked-checkbox" type="checkbox" value="" 
                    class="w-7 h-7 ml-3 rounded-full text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 
                    dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ml-2 text-sm font-medium text-white">Meus comentários</label>
            </div>
       </form>
    


        <div class="container px-5 py-24 mx-auto">    
            <div class="flex flex-wrap -m-4">
                @forelse ($listComments as $comments)
                    <div class="p-4 md:w-1/3">
                        <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col shadow-xl">
                            <div class="flex items-center mb-3">
                                @if ($comments->user->avatar)
                                    <img
                                        style="width:35px;"
                                        class="rounded-full"
                                        src="{{ url("storage/{$comments->user->avatar}") }}" 
                                    >
                                @else
                                    <img style="width:35px;" 
                                        src="{{ url('images/user.png') }}" 
                                        title="Perfil" />
                                @endif
    
                                @if (auth()->user()->id == $comments->user->id)
                                    <p class="ml-2">
                                        Meu usuário
                                    </p>
                                @else
                                    <h2 class="ml-3 text-gray-900 text-lg title-font font-medium">
                                        {{ $comments->user->name }} 
                                    </h2>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <P style="font-size: 14px;">
                                    Data postada: {{$comments->created_at }}
                                </P>
                                <p class="leading-relaxed text-base mt-10">
                                    {{ $comments->description }}
                                </p>
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
        </div>
        <div class="ml-2">
            @if ($listComments->total() > 6)
                <nav class="flex justify-between items-center pt-4" aria-label="Table navigation">
                    <ul class="inline-flex items-center -space-x-px py-2.5 px-2.5">
                        @if ($listComments->currentPage() > 1)
                            <li>
                                <a href="?page={{ $listComments->currentPage() - 1 }}" class="block py-2 px-3 ml-0 
                                    leading-tight text-gray-500 bg-white 
                                    rounded-l-lg border border-gray-300 hover:bg-gray-100 
                                    hover:text-gray-700 dark:bg-gray-800 
                                    dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 
                                    dark:hover:text-white">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" 
                                        fill="currentColor" viewBox="0 0 20 20" 
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" 
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 
                                            1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="#" aria-current="page" 
                                class="py-2 px-3 text-blue-600 bg-blue-50 border 
                                border-gray-300 hover:bg-blue-100 hover:text-blue-700 
                                dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                {{ $listComments->currentPage() }}
                            </a>
                        </li>
                        @if ($listComments->currentPage() < $listComments->lastPage())
                            <li>
                                <a href="?page={{ $listComments->currentPage() + 1 }}" class="block py-2 px-3 
                                    leading-tight text-gray-500 bg-white 
                                    rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 
                                    dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 
                                    dark:hover:text-white">
                                    <span class="sr-only">Next</span>
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" 
                                            xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" 
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 
                                            1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>
@endsection















