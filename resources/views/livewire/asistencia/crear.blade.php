<x-jet-dialog-modal wire:model="modal" maxWidth="2xl">
    <x-slot name="title">
        {{ __('Crear Registro de Asistencia') }}
    </x-slot>
    <x-slot name="content">
        <form>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-4">
                    <label for="asistencia" class="block text-gray-700 text-sm font-bold mb-2">Fecha asistencia:</label>
                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fecha" wire:model="fecha">
                </div>
                @if(count($temporadas) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold text-gray-700 text-sm">Temporada:</label>
                        <select name="temporada_id" wire:model="temporada_id" wire:change="cambioTemporada" 
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione un temporada </option>
                            @foreach($temporadas as $temporada)
                                <option value="{{ $temporada->id }}">{{ $temporada->nombre }}</option>
                            @endforeach
                        </select>
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
                    </div>
                @endif
                @if(count($personas) > 0)
                    <div class="mb-4 items-center">
                        <label class="inline-block w-32 font-bold text-emerald text-base">Estudiantes:</label>                                    
                    </div>
                    @foreach($personas as $p)                           
                        <!-- Persona : {{var_export($p['nombre'])}}                                        -->
                        <div class="mb-4">
                        <!-- class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" -->
                            <label class="inline-block w-32 font-bold text-gray-700 text-xs">{{ $p['nombre'] }} - {{ $p['apellido'] }}</label>
                            <input type="checkbox" wire:model="personas_presentes" value="{{ $p['id'] }}"/> 
                        </div>
                    @endforeach
                    {{-- Asistencias: {{var_export($personas_presentes)}} --}}
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