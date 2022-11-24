@extends('template.app')

@section('title', "Comentário do produto")

@section('content')

    <div class="text-gray-600 body-font">

        <h1 class="ml-3" style="font-size: 35px;">
            Comentarios e avaliações do produto: <b>{{ $product->name }}</b>
        </h1>
        <hr class="mt-5">

        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                @forelse ($listComments as $comments)

                    <div class="p-4 md:w-1/3">
                        <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col shadow-xl">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" 
                                        stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <h2 class="ml-3 text-gray-900 text-lg title-font font-medium">
                                    {{ $comments->user->name }} 
                                </h2>
                                @if (auth()->user()->id == $comments->user->id)
                                    <p class="ml-2">
                                        (meu post)
                                    </p>
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
                    <div class="w-full shadow-md sm:rounded-lg mt-3">
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















