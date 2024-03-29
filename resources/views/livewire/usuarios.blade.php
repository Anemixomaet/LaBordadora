@php
use Spatie\Permission\Models\Role;
@endphp
<div>
    <x-slot name="header">
        <h1 class="text-gray-900">Usuarios</h1>
    </x-slot>

    <div class="py-1">
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
                <x-jet-secondary-button wire:click="crear()" class="mt-3 mb-3" wire:loading.attr="disabled">
                    {{ __('Nuevo') }}
                </x-jet-secondary-button>
                <x-jet-secondary-button wire:click="generarPDF()" class="mt-3 mb-3" wire:loading.attr="disabled">
                    {{ __('Reporte PDF') }}
                </x-jet-secondary-button>
                <x-jet-secondary-button wire:click="generarExcel()" class="mt-3 mb-3" wire:loading.attr="disabled">
                    {{ __('Reporte EXCEL') }}
                </x-jet-secondary-button>
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
                    @include('livewire.usuario.crear')
                @endif
                <table class="table-fixed max-w-full">
                    <thead>
                        <tr class="bg-gray-50 text-black">
                            <th class="px-4 py-2">Nombres</th>
                            <th class="px-4 py-2">Email</th>   
                            <th class="px-4 py-2">Cédula</th>
                            <th class="px-4 py-2">Teléfono</th>
                            <th class="px-4 py-2">Fecha Nacimiento</th>
                            <th class="px-4 py-2">Genero</th>  
                            <th class="px-4 py-2">Imagen</th>  
                            <th class="px-4 py-2">Rol</th>                  
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)        
                            <tr>
                                <td class="border px-4 py-2">{{$usuario->name}}</td>
                                <td class="border px-4 py-2">{{$usuario->email}}</td>
                                <td class="border px-4 py-2">{{$usuario->cedula}}</td>
                                <td class="border px-4 py-2">{{$usuario->telefono}}</td>
                                <td class="border px-4 py-2">{{$usuario->fechaNacimiento}}</td>
                                <td class="border px-4 py-2">{{$usuario->genero}}</td>
                                {{-- <td class="border px-4 py-2">{{$this->calcularEdad($usuario->fechaNacimiento) }}</td> --}}
                                <td class="border px-4 py-2">
                                    @if($usuario->profile_photo_path)
                                        <img src="{{ Str::replace('/public', '', asset('storage/'.$usuario->profile_photo_url)) }}" width="40%">
                                    @else
                                        <span class="text-gray-500">Sin imagen</span>
                                    @endif
                                </td>
                               
                                <td class="border px-4 py-2">
                                    @foreach ($usuario->roles as $rol)
                                        {{ $rol->name }}<br>
                                    @endforeach
                                </td>                                       
                                <td class="border px-4 py-2 text-center">   
                                    <x-jet-button wire:click="editar({{$usuario->id}})" class="font-bold">
                                        {{ __('Editar') }}
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="borrar({{$usuario->id}})" class="font-bold">
                                        {{ __('Borrar') }}
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                        @endforeach                        
                    </tbody>                    
                </table>
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
</div>