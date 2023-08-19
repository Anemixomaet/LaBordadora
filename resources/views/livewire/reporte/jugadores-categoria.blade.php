<div>
    <x-slot name="header">
        <h1 class="text-gray-900">Jugadores por categoria</h1>
    </x-slot>
    
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <div class="border-gray-900/10 pb-12">
                    <div class="mt-10 grid grid-cols-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="city" class="px-3 block text-sm font-medium leading-6 text-gray-900">Nombre</label>
                            <div class="px-3">
                                <input type="text" wire:model="nombre" name="nombre" id="nombre" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="region" class="px-3 block text-sm font-medium leading-6 text-gray-900">Cedula</label>
                            <div class="px-3">
                                <input type="text" wire:model="cedula" name="cedula" id="cedula" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="postal-code" class="px-3 block text-sm font-medium leading-6 text-gray-900">Categoria</label>
                            <div class="px-3">
                                <!-- <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> -->
                                <select name="categoria" wire:model="categoria" 
                                    class="w-full leading-tight bg-white border border-gray-400 rounded shadow appearance-none hover:border-gray-500 focus:outline-none focus:shadow-outline">
                                    <option value="">Seleccione una categoria</option>
                                    @foreach($categorias as $categori)
                                        <option value="{{ $categori->id }}">{{ $categori->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <x-jet-secondary-button wire:click="generarPDF()" class="mt-7 ml-3">
                    {{ __('Reporte') }}
                </x-jet-secondary-button>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-50 text-black">
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Apellido</th>
                            <th class="px-4 py-2">Categoria</th>
                            <th class="px-4 py-2">Cedula</th>
                            <th class="px-4 py-2">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jugadores as $jugador)        
                            <tr>                                
                                <td class="border px-4 py-2">{{$jugador->nombre}}</td>
                                <td class="border px-4 py-2">{{$jugador->apellido}}</td>
                                <td class="border px-4 py-2">{{$jugador->categoria}}</td>
                                <td class="border px-4 py-2">{{$jugador->cedula}}</td>
                                <td class="border px-4 py-2">{{$jugador->email}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </div>
    </div>
</div>
