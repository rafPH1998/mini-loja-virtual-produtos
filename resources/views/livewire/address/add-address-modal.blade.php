<div>
    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content bg-gray-900">
            <div class="modal-header">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Cadastrar endereço</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="flex flex-wrap">
                        <div class="text-white text-xs p-2 w-1/2">
                            <div class="relative">
                                <label>Endereço</label>
                                <input type="text" id="street" name="street" 
                                class="bg-gray-800 appearance-none rounded 
                                w-full py-2 px-3 text-white 
                                leading-tight focus:outline-none focus:shadow-outline" 
                                wire:model.defer="street">
                            </div>
                            <span class="text-red-500">Erro</span>
                        </div>
    
                        <div class="text-white text-xs p-2 w-1/2">
                            <div class="relative">
                                <label>Complemento</label>
                                <input type="text" id="address" name="address" 
                                    class="bg-gray-800 appearance-none rounded 
                                    w-full py-2 px-3 text-white 
                                    leading-tight focus:outline-none focus:shadow-outline" 
                                    wire:model.defer="address"> 
                            </div>
                        </div>

                        <div class="text-white text-xs p-2 w-1/2">
                            <div class="relative">
                                <label>Número</label>
                                <input type="text" id="number" name="number" 
                                    class="bg-gray-800 appearance-none rounded w-full py-2 px-3 text-white 
                                    leading-tight focus:outline-none focus:shadow-outline"
                                    wire:model.defer="number"> 
                            </div>
                        </div>

                        <div class="text-white text-xs p-2 w-1/2">
                            <div class="relative">
                                <label>Bairro</label>
                                <input type="text" id="district" name="district" 
                                    class="bg-gray-800 appearance-none rounded 
                                    w-full py-2 px-3 text-white 
                                    leading-tight focus:outline-none focus:shadow-outline" 
                                    wire:model.defer="district"> 
                            </div>
                        </div>

                        <div class="text-white text-xs p-2 w-1/2">
                            <div class="relative">
                                <label>Telefone (opcional)</label>
                                <input type="text" id="phone" name="phone" 
                                    class="bg-gray-800 appearance-none rounded 
                                    w-full py-2 px-3 text-white 
                                    leading-tight focus:outline-none focus:shadow-outline" 
                                    wire:model.defer="phone"> 
                            </div>
                        </div>

                        <div class="text-white text-xs p-2 w-1/2">
                            <div class="relative">
                                <label>Celular</label>
                                <input type="text" id="cellphone" name="cellphone" 
                                    class="bg-gray-800 appearance-none rounded 
                                    w-full py-2 px-3 text-white 
                                    leading-tight focus:outline-none focus:shadow-outline" 
                                    wire:model.defer="cellphone"> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="text-white 
                    focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 
                    mb-2 focus:outline-none bg-green-700 hover:bg-green-800
                    focus:ring-green-300 dark:bg-green-600
                    dark:hover:bg-green-700 dark:focus:ring-green-800">
                <i class="fas fa-cloud-upload-alt"></i>
                Salvar
              </button>
            </div>
          </div>
        </div>
    </div>
</div>

@push('component-scripts')
  <script>
    (function($){
        $(document).on('livewire:load', function() {
            $('.combo').select2({ 
                "language": "pt-BR",
            })
            $('select[name="type"]').on('change', function(){
                @this.type = $(this).val()
            })
            $('select[name="status"]').on('change', function(){
                @this.status = $(this).val()
            })
            Livewire.on('modalClose', (modalId) => {
                $(modalId).modal('hide')
            })
            Livewire.hook('message.processed', (message, component) => {
                $('.combo').select2();
            })                
        })
    })(jQuery)
  </script>
@endpush

