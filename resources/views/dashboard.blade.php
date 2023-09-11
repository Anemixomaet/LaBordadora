<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center bg-blue-200 p-2">
            {{ __('DASHBOARD') }}
        </h2>
    </x-slot>
        
        <div class="flex">
            <!-- Primera sección para el primer gráfico -->
            <div class="w-1/3 float-left">
                <div class="items-center px-3 py-4 shadow-sm rounded-md bg-white">
                    @livewire('dashboard')
                </div>
            </div>
            <!-- Segunda sección para el segundo gráfico -->
            <div class="w-1/3 mx-auto">
                <div class="items-center px-3 py-4 shadow-sm rounded-md bg-white">
                    @livewire('pie-dashboard')
                </div>
            </div>
            <!-- Tercera sección para el tercer gráfico -->
        </div>       

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.x.x/dist/alpine.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @livewireScripts
        @livewireChartsScripts
    @endsection
</x-app-layout>

