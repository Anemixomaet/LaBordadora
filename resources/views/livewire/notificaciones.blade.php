<div>
    <x-slot name="header">
        <h1 class="text-gray-900">Notificacion</h1>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if(session()->has('message'))
                    <div class="bg-teal-100 rounded-b text-teal-900 px-4 py-6 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <h4>{{ session('message')}}</h4>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <label for="textoBuscar" class="block text-gray-700 text-sm font-bold mb-2">Buscar:</label>
                <input type="text" placeholder="Ingreso un texto a buscar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="textoBuscar" wire:model="textoBuscar">
            </div>
        </div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if($modal)                
                    @include('livewire.inscripcion.crear')
                @endif
                <table class="table-fixed max-w-full">
                    <thead>
                        <tr class="bg-gray-50 text-black">
                            <th class="px-4 py-2">Temporada</th>
                            <th class="px-4 py-2">Categoria</th>
                            <th class="px-4 py-2">Jugador</th>
                            <th class="px-4 py-2">Observacion</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notificaciones as $inscripcion)          
                            <tr>
                                <td class="border px-4 py-2">{{$inscripcion->detalle }}</td>
                                <td class="border px-4 py-2">{{$inscripcion->nombre}}</td>
                                <td class="border px-4 py-2">{{$inscripcion->nombres}} {{$inscripcion->apellidos}}</td>
                                <td class="border px-4 py-2">{{$inscripcion->observacion}}</td>
                               
                               
                                <td class="border px-4 py-2 text-center">   
                                    <x-jet-button wire:click="inasistencia({{$inscripcion->id}})" class="font-bold">
                                        {{ __('Inasistencia') }}
                                    </x-jet-button>
                                    <x-jet-button wire:click="pago({{$inscripcion->id}})" class="font-bold">
                                        {{ __('Pago') }}
                                    </x-jet-button>
                                    <x-jet-button wire:click="mensaje({{$inscripcion->id}})" class="font-bold">
                                        {{ __('Mensaje') }}
                                    </x-jet-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $notificaciones->links() }}
            </div>
        </div>
    </div>
</div>
