<x-app>
    <div class="lg:w-4/5 mx-auto flex flex-wrap shadow-2xl">
        <div class="xl:w-1/4 md:w-1/2 p-4">
            sem imagem
        </div>
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0 ml-10">
            <h1 class="text-3xl title-font font-medium mb-1 text-white">{{ $product->name }}</h1>
            <hr/>

            <div class="mt-5">
                @if (Session::has('error'))
                    <p class="text-red-500">
                        {{ Session::get('error') }}
                    </p>
                @elseif (Session::has('success'))
                    <p class="text-green-500">
                        {{ Session::get('success') }}
                    </p>
                @elseif (Session::has('warning'))
                    <p class="text-yellow-500">
                        {{ Session::get('warning') }}
                    </p>
                @endif
            </div>

            <p class="leading-relaxed mt-5 text-white">
                <b>Descrição do produto: </b>
                <p class="text-gray-500">{{ $product->description }}</p>
            </p>
            <div class="my-3 mt-5 text-white">
                <b>Quantidade:</b>
                <div id="result_do_php" style="display: block;">
                    <p>
                        <p class="inline-flex items-center
                             px-3 py-0.5 rounded-full text-sm font-medium
                             {{ $product->quantity_inventory > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}}">
                             <b>({{ $product->quantity_inventory }}) {{ $product->quantity_inventory > 0 ? 'Em estoque' : 'Estoque vazio' }}</b>
                         </p>
                    </p>
                </div>
                <div id="result_do_js" style="display: none;">
                    <p>
                        <p class="inline-flex items-center
                             px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                             <b id="result">teste</b>
                         </p>
                    </p>
                </div>
            </div>

            <div class="my-3 mt-5">
                <b class="text-white">Estado do produto:</b>
                @foreach ($qualityStatus as $status)
                    <p class="text-gray-500">
                        {{ $product->quality === $status->name ? $status->value : '' }}
                    </p>
                @endforeach    
            </div>
            <p class="mt-7 text-white"><b>Autor do produto postado:</b></p>
            <div class="flex mt-3">
                <p class="mb-1 text-sm dark:text-gray-800">
                    @if ($product->user->avatar)
                        <img
                            class="rounded-full w-12 h-12"
                            src="{{ url("storage/{$product->user->avatar}") }}" 
                        >
                    @else
                        <img class="rounded-full w-12 h-12" src="{{ url('images/user01.svg') }}" title="Perfil" />
                    @endif
                </p>
                @if ($product->user->id == auth()->user()->id)
                    <p class="mt-3 ml-2 text-green-500">
                        (meu produto)
                    </p>
                @else
                    <p class="mt-3 ml-2 text-gray-500">
                        {{ $product->user->name }}
                    </p>
                @endif
        </div>
        <div class="flex border-t-2 border-gray-100 mt-6 pt-6">
            <span class="title-font font-medium text-2xl text-white">
                ${{ number_format($product->price , 2, ',', '.') }}
            </span>
        </div>

        @can('product-users', $product)
            <form action="{{route('products.create_comment') }}" method="POST" class="mt-10">
                @csrf
                @if (Session::has('comment_success'))
                    <x-alerts.success>
                        {{ Session::get('comment_success') }}
                    </x-alerts.success>
                @endif

                <input type="hidden" name="id" value="{{ $product->id }}">
                <textarea 
                    name="description" cols="30" rows="4" 
                    class="w-full px-5 border-2
                    py-2 text-gray-700 bg-gray-200 
                    focus:outline-none rounded @error('description') border-red-500 @enderror" 
                    placeholder="O que achou do produto?"
                ></textarea>
                @error('description')
                    @foreach ($errors->messages()['description'] as $error)
                        <span class="text-red-500">{{ $error }}</span>
                    @endforeach
                @enderror

                <div class="flex flex-row-reverse">
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                        focus:ring-blue-300 font-medium rounded-lg 
                        text-sm px-5 py-2 dark:bg-blue-600 
                        dark:hover:bg-blue-700 focus:outline-none 
                        dark:focus:ring-blue-800 mt-1">
                        Criar comentário
                    </button>               
                </div>
            </form> 

            <form action="#" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                <input type="hidden" name="id" value="{{ $product->id }}" id="id">
                <input type="hidden" name="quantity_inventory" value="{{ $product->quantity_inventory }}" id="quantity_inventory">

                <button 
                    id="submitButton"
                    class="text-white bg-green-700 hover:bg-green-800 
                    focus:ring-4 focus:ring-green-300 font-medium rounded-lg 
                    text-sm px-4 py-2.5 mr-2 mb-2 dark:bg-green-600 
                    dark:hover:bg-green-700 focus:outline-none 
                    dark:focus:ring-green-800">
                    @if ($product->shopping)
                        Remover compra
                    @else
                        Comprar
                    @endif
                </button>
            </form>
        @endcan
    </div>
</x-app>


<script>

document.getElementById("submitButton").addEventListener("click", async function(event){

    const submitButton  = document.getElementById('submitButton');
    const csrfToken     = document.getElementById("_token").value;
    const id            = document.getElementById("id").value;
    const result_do_php = document.getElementById("result_do_php");
    const result_do_js  = document.getElementById("result_do_js");
    const result        = document.getElementById("result");
    const qtdAtual      = document.getElementById("quantity_inventory").value;

    //alert(qtdAtual)
    
    submitButton.innerHTML = 'Comprando...';
    submitButton.disabled  = true;

    event.preventDefault();

    const url = `http://localhost:8989/products/buy`;

    try {
        const response = await fetch(url, {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'accept': 'application/json'
            },
            body: JSON.stringify({
                id    : id,
                _token: csrfToken
            })
        });

        const { quantity, countShopping, error, warning, success } = await response.json();
        const buttonText = countShopping || error ? 'Comprar' : 'Remover compra';
        submitButton.innerHTML = buttonText;

        if (error) {
            swal('Erro!', error, 'error');
        } else if (warning) {
            swal('Aviso!', warning, 'warning');
            showButton(quantity);
        } else {
            result_do_php.style.display = 'none'
            result_do_js.style.display = 'block'
            showButton(quantity);
            swal('Success!', success, 'success');
        }

    } catch (error) {
        swal("Erro!", error, 'error');
    } finally {
        submitButton.disabled = false;
    }
})

const showButton = (qtd) => {
    if (qtd > 0) {
        result.innerHTML = `(${qtd}) Em estoque`
    } else { 
        result.innerHTML = `(${qtd}) Estoque vazio`
    }
}
</script>
















