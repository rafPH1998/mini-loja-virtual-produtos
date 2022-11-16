@extends('template.app')

@section('title', "Comentário do produto")

@section('content')

    <div class="text-gray-600 body-font">
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
                            Nenhum comentário para esse produto!
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection















