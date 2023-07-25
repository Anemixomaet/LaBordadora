<x-jet-dialog-modal wire:model="modal" maxWidth="2xl">
    <x-slot name="title">
        {{ __('Crear Nueva Inscripcion') }}
    </x-slot>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
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
        </div>
    </div>
    <x-slot name="content">
        <form>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                
                @if(count($temporadas) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold">Temporada:</label>
                        <!-- wire:change="cambioTemporada" -->
                        <select name="id_temporada" wire:model="temporada_id" wire:change="cambioTemporada" 
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione una Temporada </option>
                            @foreach($temporadas as $temporada)
                                <option value="{{ $temporada->id }}">{{ $temporada->detalle }} </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if(count($categorias) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold">Categoria:</label>
                        <select name="id_categoria" wire:model="categoria_id" 
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione una Categoria </option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre}} </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if(count($jugadores) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold">Jugador:</label>
                        <select name="id_persona" wire:model="persona_id" 
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione un jugador </option>
                            @foreach($jugadores as $jugador)
                                <option value="{{ $jugador->id }}">{{ $jugador->nombre }} {{ $jugador->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="mb-4">
                    <label for="tipo" class="block text-gray-700 text-sm font-bold mb-2">Observacion:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="observacion" wire:model="observacion">
                </div>  
                
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click.prevent="guardar()">
            {{ __('Guardar') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2"
                    wire:click="cerrarModal()"
                    wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>