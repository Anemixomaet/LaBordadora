<x-jet-dialog-modal wire:model="modal" maxWidth="2xl">
    <x-slot name="title">
        {{ __('Crear nuevo Jugador') }}
    </x-slot>
    <x-slot name="content">
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
                    <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" wire:model="nombre" required>
                    @error('nombre') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="apellido" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="apellido" wire:model="apellido">
                    @error('apellido') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="cedula" class="block text-gray-700 text-sm font-bold mb-2">Cedula:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cedula" wire:model="cedula">
                    @error('cedula') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Telefono:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefono" wire:model="telefono">
                    @error('telefono') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" wire:model="email">
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="fechaNac" class="block text-gray-700 text-sm font-bold mb-2">Fecha Nacimiento:</label>
                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fechaNac" wire:model="fechaNac">
                    @error('fechaNac') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                {{-- <div class="mb-4">
                    <label for="tipo" class="block text-gray-700 text-sm font-bold mb-2">Edad:</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="edad" wire:model="edad" readonly>
                </div> --}}
                <div class="mb-4">
                    <label for="imagen" class="block text-gray-700 text-sm font-bold mb-2">Imagen:</label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="imagen" wire:model="imagen">
                    @error('imagen') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    @if ($imagen)
                        <!-- {{-- Vista previa imagen: {{ $imagen->temporaryUrl() }} --}} -->
                        <img src="{{ $imagen->temporaryUrl() }}" width="10%">
                    @endif
                </div>

                @if(count($generos) > 0)
                    <div class="mb-4">
                        <label class="inline-block w-32 font-bold">Genero: </label>
                        <select name="genero_nombre" wire:model="genero" 
                            class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                            <option value="">Seleccione un genero</option>
                            @foreach($generos as $llave => $valor)
                                <option value="{{ $llave }}">{{ $valor }}</option>
                            @endforeach
                        </select>
                        @error('genero') <span class="text-red-500">{{ $message }}</span> @enderror 
                    </div>
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