<div>
    <x-slot name="header">
        <h1 class="text-gray-900">Jugadores por categoria</h1>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if(session()->has('message'))
                    <div class="bg-teal-100 rounded-b text-teal-900 px-4 py-4 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <h4>{{ session('message')}}</h4>
                            </div>
                        </div>
                    </div>
                @endif
                <x-jet-secondary-button wire:click="generarPDF()" class="mt-7 mb-7">
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
