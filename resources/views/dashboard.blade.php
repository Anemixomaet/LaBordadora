<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center" >
            {{ __('DASHBOARD') }}      
        </h2>
    </x-slot> 
    <div class="flex justify-between">
        <div class="w-1/2">
            <div class="items-center px-3 py-4 shadow-sm rounded-md bg-white">
                @livewire('dashboard')
            </div>
        </div>
        {{-- <div class="w-1/2">
            <div class="items-center px-3 py-4 shadow-sm rounded-md bg-white">
                @livewire('dashboard')
            </div>
        </div> --}}
    </div>
    
   
        @livewireScripts
        @livewireChartsScripts
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        
</x-app-layout>  
