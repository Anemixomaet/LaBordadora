<x-jet-dialog-modal wire:model="modal" maxWidth="2xl">
    <x-slot name="title">
        {{ __('Crear Registro de Pago') }}
    </x-slot>
    <x-slot name="content">
        <form>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-4">
                    <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Fecha pago:</label>
                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fecha" wire:model="fecha">
                    @error('fecha') <!-- Mostrar errores de validación para el campo fecha -->
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="mb-4">
                    <label for="comprobante" class="block text-gray-700 text-sm font-bold mb-2">Comprobante:</label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="comprobante" wire:model="comprobante" optional>
                    
                </div>
                <div class="mb-4">
                    @if ($comprobante)
                        <img src="{{ $comprobante->temporaryUrl() }}" width="10%">
                    @endif
                </div> --}}
                <div class="mb-4">
                    <label for="comprobante" class="block text-gray-700 text-sm font-bold mb-2">Comprobante:</label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="comprobante" wire:model="comprobante" optional>
                </div>
                <div class="mb-4">
                    @if ($comprobante instanceof \Livewire\TemporaryUploadedFile)
                        <img src="{{ $comprobante->temporaryUrl() }}" width="10%">
                    @endif
                </div>
                
                <div class="mb-4">
                    <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Detalle:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="detalle" wire:model="detalle">
                </div>
                @if(count($temporadas) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold text-gray-700 text-sm">Temporada:</label>
                        <select name="temporada_id" wire:model="temporada_id" wire:change="cambioTemporada" 
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione un temporada </option>
                            @foreach($temporadas as $temporada)
                                <option value="{{ $temporada->id }}">{{ $temporada->detalle }}</option>
                            @endforeach
                        </select>
                        @error('temporada_id') <!-- Mostrar errores de validación para el campo fecha -->
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                    </div>
                @endif
                @if(count($categorias) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold text-gray-700 text-sm">Categoria:</label>
                        <select name="categoria_id" wire:model="categoria_id" wire:change="cambioCategoria"
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione un categoria </option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id') <!-- Mostrar errores de validación para el campo fecha -->
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                    </div>
                @endif
                @if(count($personas) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold text-gray-700 text-sm">Persona:</label>
                        <select name="id_persona" wire:model="persona_id"
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione un persona </option>
                            @foreach($personas as $personaAux)
                                <option value="{{ $personaAux['id'] }}">{{ $personaAux['nombre']}} {{ $personaAux['apellido'] }}</option>
                            @endforeach
                        </select>
                        @error('id_persona') <!-- Mostrar errores de validación para el campo fecha -->
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                    </div>
                    {{-- Personas: {{var_export($personas)}} --}}
                @endif              
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