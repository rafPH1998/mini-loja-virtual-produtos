<x-app>
    <div>
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

        
        <div class="shadow-lg shadow-gray-900/50">
            <form method="POST" action="{{ route('address.store') }}" class="bg-gray-900 p-10 rounded-lg">
                @csrf

                <div class="relative z-0 w-full mb-6 group">
                    <x-inputs-address.text type="text" id="street" name="street" label="Endereço" value="{{old('street')}}"/>
                    @error('street')
                        @foreach ($errors->messages()['street'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>
            
                <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <x-inputs-address.text type="text" id="address" name="address" label="Complemento" value="{{old('address')}}"/>
                    @error('address')
                        @foreach ($errors->messages()['address'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <x-inputs-address.text type="text" id="number" name="number" label="Número" value="{{old('number')}}"/>
                    @error('number')
                        @foreach ($errors->messages()['number'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <x-inputs-address.text type="text" id="district" name="district" label="Bairro" value="{{old('district')}}" />
                    @error('district')
                        @foreach ($errors->messages()['district'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <x-inputs-address.text id="phone" type="text" name="phone" label="Telefone fixo (opcional)" value="{{old('phone')}}"/>
                    @error('phone')
                        @foreach ($errors->messages()['phone'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <x-inputs-address.text id="cellphone" type="text" name="cellphone" label="Celular" value="{{old('cellphone')}}"/>
                    @error('cellphone')
                        @foreach ($errors->messages()['cellphone'] as $error)
                            <span class="text-red-500">{{ $error }}</span>
                        @endforeach
                    @enderror
                </div>
                </div>

                <div class="p-2 w-full">
                    <x-button 
                        blue>
                        Adicionar
                    </x-button>
                </div>

            </form>
        </div>
    </div>
</x-app>