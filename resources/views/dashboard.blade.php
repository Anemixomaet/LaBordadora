<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('DASHBOARD') }}
        </h2>
    </x-slot>
        <!-- Primera sección para el primer gráfico -->
        <div class="w-1/2 justify-center">
            <div class="items-center px-3 py-4 shadow-sm rounded-md bg-white">
                @livewire('dashboard')
            </div>
        </div>

        <!-- Segunda sección para el segundo gráfico -->
        {{-- div class="w-1/2 justify-center">
            <div class="items-center px-3 py-4 shadow-sm rounded-md bg-white">
                @livewire('dashboardpie')
            </div>
        </div> --}}

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.x.x/dist/alpine.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @livewireScripts
        @livewireChartsScripts
    @endsection
</x-app-layout>

