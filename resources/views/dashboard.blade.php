<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-screen-2x1 mx-auto sm:px-50 lg:px-1">
            <div class="max-w-6xl mx-auto sm:px-4 lg:px-2">
                <p style="text-align:center">
                <!-- <img src="https://pymstatic.com/8535/conversions/frases-futbol-wide.jpg"> -->
                @livewire('chart.dashboard')
            </div>
        </div>
    </div>
</x-app-layout>
