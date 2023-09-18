<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center bg-blue-200 p-2">
            {{ __('DASHBOARD') }}
            <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        </h2>
    </x-slot>
        
        
            <!-- Primera sección para el primer gráfico -->
            <div class="w-1/2 float-left">
                <div class="items-center px-3 py-4 shadow-sm rounded-md bg-white">
                    @livewire('dashboard')
                </div>
            </div>
            <!-- Segunda sección para el segundo gráfico -->
            <div class="w-1/2 mx-auto">
                <div class="items-center px-3 py-4 shadow-sm rounded-md bg-white">
                    @livewire('pie-dashboard')
                </div>
            </div>
              

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.x.x/dist/alpine.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts" crossorigin="anonymous"></script>
        <script src="{{ asset('js/alpine.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/apexcharts.min.js') }}" crossorigin="anonymous"></script>
        @livewireScripts
        @livewireChartsScripts
    @endsection
</x-app-layout>

