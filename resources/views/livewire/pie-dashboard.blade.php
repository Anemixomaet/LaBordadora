{{-- livewire.pie-dashboard.blade.php --}}

<div class="shadow rounded p-4 border bg-white" style="height: 32rem;">
    <h2 class="text-center mb-4" ><strong>{{ $chartTitle }}</h2>
    <livewire:livewire-pie-chart
        key="{{ $chartData->reactiveKey() }}"
        :pie-chart-model="$chartData"
    />
</div>
