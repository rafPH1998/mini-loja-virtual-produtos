<x-app>
    <div id="form-container" class="mx-auto overflow-hidden shadow-lg mb-2 bg-gray-900 border-4 rounded-lg md:w-3/6 sm:w-4/6 border-gray-400">
        <div class="flex items-center justify-between mb-2 px-5 py-5">
            <h1 class="text-2xl font-medium title-font mb-2 text-white">Adicionar endereço</h1>
        </div>

        @if (Session::has('success'))
            <p class="text-green-500 flex items-center justify-center">
                {{ Session::get('success') }}
            </p>
        @endif

        @if (Session::has('error'))
            <p class="text-red-500 flex items-center justify-center">
                {{ Session::get('error') }}
            </p>
        @endif

        <form method="POST" class="px-10 py-10" action="{{ route('address.store') }}">
            <div class="flex flex-wrap">
                @csrf

                <div class="p-2 w-1/2">
                    <x-inputs.text type="text" id="street" name="street" label="Rua" value="{{old('street')}}"/>
                    @error('street')
                        @foreach ($errors->messages()['street'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <x-inputs.text type="text" id="address" name="address" label="Complemento" value="{{old('address')}}"/>
                    @error('address')
                        @foreach ($errors->messages()['address'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <x-inputs.text type="text" id="number" name="number" label="Número" value="{{old('number')}}"/>
                    @error('number')
                        @foreach ($errors->messages()['number'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <x-inputs.text type="text" id="district" name="district" label="Bairro" value="{{old('district')}}"/>
                    @error('district')
                        @foreach ($errors->messages()['district'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <x-inputs.text type="text" id="phone" name="phone" label="Telefone fixo (opcional)" value="{{old('phone')}}"/>
                    @error('phone')
                        @foreach ($errors->messages()['phone'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-1/2">
                    <x-inputs.text type="text" id="cellphone" name="cellphone" label="Celular" value="{{old('cellphone')}}"/>
                    @error('cellphone')
                        @foreach ($errors->messages()['cellphone'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="p-2 w-full">
                    <x-button 
                        blue>
                        Adicionar
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</x-app>