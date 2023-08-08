<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persona;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;


class Dashboard extends Component
{
   

    public function render()
    {
        $jugadores = DB::table('personas')->get();
        $columnChartModel = (new ColumnChartModel())
            ->setTitle('Jugadores por género')
            ->setColors(['#284e9c', '#e091c2','#90cdf4']);
        //dd(Persona::where('genero', 'M')->count()); //prueba error
        //solucion del error es psando los datos como enteros y no como arreglo

        $columnChartModel->addColumn('Hombres', Persona::where('genero', 'M')->count(), '#284e9c');
        $columnChartModel->addColumn('Mujeres', Persona::where('genero', 'F')->count(), '#e091c2');
        $columnChartModel->addColumn('Otros', Persona::where('genero', 'O')->count(), '#90cdf4');
        
        //dd($columnChartModel);

        $pieChartData = $this->getChartData(); 

        return view('livewire.dashboard', [
            'columnChartModel' => $columnChartModel,
            'pieChartData' => $pieChartData, 
        ]);

    }

    public function getChartData()
    {
        $categorias = Categoria::all();
        $chartData = (new PieChartModel()); 

        foreach ($categorias as $categoria) {
            $jugadoresInscritos = DB::table('inscripciones')
                ->where('id_categoria', $categoria->id)
                ->count();

            $chartData->addSlice($categoria->nombre, $jugadoresInscritos, '#'.substr(md5(rand()), 0, 6));
        }

        return $chartData;
    }
}
