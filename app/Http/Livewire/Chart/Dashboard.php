<?php

namespace App\Http\Livewire\Chart;

use Livewire\Component;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Dashboard extends Component
{
    public $labels = [];

    public $colors = [];

    public function render()
    {
        // $start_day = Carbon::now()->subDays(11);
        // $end_day = Carbon::now();
        $items = Persona::select('genero', DB::raw('COUNT(*) as total'))
                        ->groupBy('genero')
                        ->get();
        $columnChartModel = (new ColumnChartModel())
                                ->setTitle(trans('Alumnos por genero'))
                                ->setAnimated(true)
                                ->withDataLabels();
                                
        // for($i = $start_day; $i < $end_day; $i->addDay(1)) 
        // {
            // $date = $i->format('d-m');
            // $filters = $items->filter(function($value, $key) use($date)
            // {
            //     return $value->column_date == $date;
            // });
            // $sum = !empty($filters->first())? $filters->first()->sum : 0;
            // array_push($this->labels, $date);
            // $this->colors[$date] = Helper::rand_color();
            //$columnChartModel->addColumn($date, $sum, $this->colors[$date]);
        //}
        $columnChartModel->addColumn("Camita", 100, "Camita");
        // foreach ($items as $item) 
        // {
        //     $columnChartModel->addColumn("Camita", 100, "Camita");
        //     //$columnChartModel->addColumn($item->genero, $item->total, $this->colors[$item->genero]);    
        // }
        
        return view('livewire.chart.dashboard', compact('columnChartModel'));
    }
}
