<x-app>
    <div id="form-container" class="mx-auto overflow-hidden shadow-lg mb-2 bg-gray-900 border-4 rounded-lg md:w-3/6 sm:w-4/6 border-gray-400">
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-white">Adicionar produto</h1>
        </div>

        <form method="POST" class="px-10 py-10" action="#" id="addForm" enctype="multipart/form-data">
            <div class="flex flex-wrap">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">

             {{--    <div class="relative">
                    <label for="image" class="leading-7 text-sm text-white">Foto</label>
                    <input type="file" id="image" name="image"
                        class="appearance-none border rounded w-full 
                        py-2 px-3 text-gray-700 
                        leading-tight focus:outline-none focus:shadow-outline">
                </div> --}}
                
                <div class="p-2 w-full">
                    <x-inputs-product.text type="text" id="name" name="name" label="Nome do produto" msgError="nameErro" />
                </div>

                <div class="p-2 w-1/2">
                    <x-inputs-product.text type="text" id="price" name="price" label="Preço" msgError="priceErro" />
                </div>

                <div class="p-2 w-1/2">
                    <x-inputs-product.text type="text" id="quantity_inventory" name="quantity_inventory" 
                        label="Estoque" 
                        msgError="inventoryErro" 
                        />
                </div>

                <x-inputs-product.select-quality id="quality" name="quality" label="Estado do produto" 
                    :qualityStatus="$qualityStatus" msgError="qualityErro" 
                    /> 

                <x-inputs-product.select-type id="type" name="type" label="Tipo do produto" 
                    :type="$type" msgError="typeErro" 
                    /> 

                <x-inputs-product.textarea id="description" name="description" label="Descrição" msgError="descErro" /> 

                <div class="p-2 w-full">
                    <x-button 
                        id="button" 
                        blue>
                        Adicionar
                    </x-button>
                </div>
                
            </div>
        </form>
    </div>
</x-app>















