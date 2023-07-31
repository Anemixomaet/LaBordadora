<x-jet-dialog-modal wire:model="modalArchivo" maxWidth="2xl">
    <x-slot name="title">
        {{ __('Cargar archivo Jugadores') }}
    </x-slot>
    <x-slot name="content">
        <!-- <form wire:submit.prevent="importData"> -->
        <form>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-4">
                    @if(session()->has('message_modal'))
                    <div class="bg-teal-100 rounded-b text-teal-900 px-4 py-4 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <h4>{{ session('message_modal')}}</h4>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="archivo" class="block text-gray-700 text-sm font-bold mb-2">Cargar archivo:</label>
                    <input type="file" wire:model="archivo" id="archivo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>                        
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click.prevent="importarJugadores()">
            {{ __('Guardar') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2"
                    wire:click="cerrarModalArchivo()"
                    wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>