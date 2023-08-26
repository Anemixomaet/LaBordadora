<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class PieDashboard extends Component
{
    public $chartTitle = 'Jugadores por Categoría';
    public function render()
    {
        $categorias = Categoria::all();
        $chartData = $this->generateChartData($categorias);
        
        
        return view('livewire.pie-dashboard', ['chartData' => $chartData], ['chartTitle' => $this->chartTitle]);
    }

    private function generateChartData($categorias)
    {
        $chartData = (new PieChartModel()); 

        foreach ($categorias as $categoria) {
            $jugadoresInscritos = DB::table('inscripciones')
                ->where('id_categoria', $categoria->id)
                ->count();

            $chartData->addSlice($categoria->nombre, $jugadoresInscritos, '#' . substr(md5(rand()), 0, 6));
        }

        return $chartData;
    }
}
