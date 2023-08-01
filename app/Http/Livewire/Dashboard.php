<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persona;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
   

    public function render()
    {
        $jugadores = DB::table('personas')->get();
        $columnChartModel=null;
        $columnChartModel = (new ColumnChartModel())
            ->setTitle('Jugadores por género')
            ->setColors(['#284e9c', '#e091c2','#90cdf4']);
        //dd(Persona::where('genero', 'F')->count()); //prueba error
        //solucion del error es psando los datos como enteros y no como arreglo

        $columnChartModel->addColumn('Hombres', Persona::where('genero', 'M')->count(), '#284e9c');
        $columnChartModel->addColumn('Mujeres', Persona::where('genero', 'F')->count(), '#e091c2');
        $columnChartModel->addColumn('Otros', Persona::where('genero', 'O')->count(), '#90cdf4');

        // $columnChartModel->addColumn('Hombres', [Persona::where('genero', 'M')->count()], '#ff0000');
        // $columnChartModel->addColumn('Mujeres', [Persona::where('genero', 'F')->count()], '#00ff00');
        // $columnChartModel->addColumn('Otros', [Persona::where('genero', 'O')->count()], '#90cdf4');
        // dd($columnChartModel);
        return view('livewire.dashboard', compact('columnChartModel'));

    }
}
