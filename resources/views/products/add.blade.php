<x-app>
    <div id="form-container" class="mx-auto overflow-hidden shadow-lg mb-2 bg-gray-900 border-4 rounded-lg md:w-3/6 sm:w-4/6 border-gray-400">
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-white">Adicionar produto</h1>
        </div>

        <form method="POST" class="px-10 py-10" action="#" id="addForm" enctype="multipart/form-data">
            <div class="flex flex-wrap">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">

                <x-inputs.text 
                    type="text" id="name" 
                    name="name" label="Nome do produto" 
                    msgError="nameErro" />

                <x-inputs.text
                    type="text" id="price" 
                    name="price" label="Preço" 
                    msgError="priceErro" />

                <x-inputs.text 
                    type="text" id="quantity_inventory" 
                    name="quantity_inventory" label="Estoque" 
                    msgError="inventoryErro" />

                <x-inputs.select-quality 
                    id="quality" name="quality" 
                    label="Estado do produto" :qualityStatus="$qualityStatus" 
                    msgError="qualityErro" /> 

                <x-inputs.select-type id="type" name="type" 
                    label="Tipo do produto" :type="$type" 
                    msgError="typeErro" /> 

                <x-inputs.textarea id="description" name="description" 
                    label="Descrição"
                    msgError="descErro" /> 

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















