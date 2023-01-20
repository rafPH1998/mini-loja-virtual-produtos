<x-app>
    <div id="form-container" class="mx-auto overflow-hidden shadow-lg mb-2 bg-gray-900 border-4 rounded-lg md:w-3/6 sm:w-4/6 border-gray-400">
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-white">Adicionar endereço</h1>
        </div>

        <form method="POST" class="px-10 py-10" action="#" id="addAddress" enctype="multipart/form-data">
            <div class="flex flex-wrap">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">

                <x-inputs.text 
                    type="text" id="address" 
                    name="address" label="Endereço" 
                    msgError="addressErro" />

                <x-inputs.text 
                    type="text" id="street" 
                    name="street" label="Rua" 
                    msgError="streetErro" />

                <x-inputs.text 
                    type="text" id="number" 
                    name="number" label="Número" 
                    msgError="numberErro" />

                <x-inputs.text 
                    type="text" id="district" 
                    name="district" label="Bairro" 
                    msgError="districtErro" />

                <x-inputs.text 
                    type="text" id="phone" 
                    name="phone" label="Telefone fixo (opcional)" 
                    msgError="phoneErro" />

                <x-inputs.text 
                    type="text" id="cellphone" 
                    name="cellphone" label="Celular" 
                    msgError="cellphoneErro" />

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