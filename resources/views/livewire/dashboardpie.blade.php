<div class="shadow rounded p-4 border bg-white" style="height: 32rem;">
    <livewire:livewire-pie-chart
    key="{{ $pieChartData->reactiveKey() }}"
    :pie-chart-model="$pieChartData"
    />
</div>
