<div class="shadow rounded p-4 border bg-white" style="height: 32rem;">
    <livewire:livewire-column-chart
    key="{{ $columnChartModel->reactiveKey() }}"
    :column-chart-model="$columnChartModel"
    />

    {{-- <livewire:livewire-line-chart
    key="{{ $lineChartData->reactiveKey() }}"
    :line-chart-model="$lineChartData"
    /> --}}
    
</div>

