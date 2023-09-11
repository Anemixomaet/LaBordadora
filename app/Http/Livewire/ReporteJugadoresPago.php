<?php

namespace App\Http\Livewire;
use App\Exports\JugadoresPagoExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Temporada;
use App\Models\Pago;
use PDF;

class ReporteJugadoresPago extends Component
{
    public $nombre = '';
    public $cedula = '';
    public $fecha;
    public $categoria = 0;
    public $temporada = 0;

    public $categorias;
    public $temporadas;

    public function render()
    {
        $this->categorias = Categoria::all();
        $this->temporadas = Temporada::all();
        $jugadores = Pago::rightjoin('inscripciones', 'inscripciones.id', '=', 'pagos.id_inscripcion')                    
                    ->leftJoin('personas', 'personas.id', '=', 'inscripciones.id_persona')
                    ->leftJoin('temporadas', 'inscripciones.id_temporada', '=', 'temporadas.id')
                    ->leftJoin('categorias', 'inscripciones.id_categoria', '=', 'categorias.id')
                    ->select('temporadas.detalle as temporada', 
                            'categorias.nombre as categoria',
                            'personas.nombre', 
                            'personas.apellido', 
                            'pagos.fecha',
                            'pagos.detalle')
                            // ,
                            // 'pagos.comprobante')
                    ->where('inscripciones.id_categoria','=', $this->categoria)
                    ->where('inscripciones.id_temporada','=', $this->temporada)
                    ->WhereYear('pagos.fecha','=',date('Y', strtotime($this->fecha)))
                    ->WhereMonth('pagos.fecha','=',date('m', strtotime($this->fecha)))
                    ->get();

        return view('livewire.reporte.jugadores-pago', compact('jugadores') );
    }
    
    public function generarPDF()
    {
        $jugadores = Pago::rightjoin('inscripciones', 'inscripciones.id', '=', 'pagos.id_inscripcion')                    
                    ->leftJoin('personas', 'personas.id', '=', 'inscripciones.id_persona')
                    ->leftJoin('temporadas', 'inscripciones.id_temporada', '=', 'temporadas.id')
                    ->leftJoin('categorias', 'inscripciones.id_categoria', '=', 'categorias.id')
                    ->select('temporadas.detalle as temporada', 
                            'categorias.nombre as categoria',
                            'personas.nombre', 
                            'personas.apellido', 
                            'pagos.fecha',
                            'pagos.detalle')
                            // ,
                            // 'pagos.comprobante')
                    ->where('inscripciones.id_categoria','=', $this->categoria)
                    ->where('inscripciones.id_temporada','=', $this->temporada)
                    ->WhereYear('pagos.fecha','=',date('Y', strtotime($this->fecha)))
                    ->WhereMonth('pagos.fecha','=',date('m', strtotime($this->fecha)))
                    ->get()
                    ->toArray();   

        $pdfContent = PDF::loadView('livewire.reporte.jugadores-pago-pdf', compact('jugadores'))->output();
        
        return response()->streamDownload(
            function () use ($pdfContent){
                echo $pdfContent;
            }, "reporte_pago.pdf"
        );
    }
    public function generarExcel()
    {
        $export = new JugadoresPagoExport($this->categoria, $this->temporada, $this->fecha);

        return Excel::download($export, 'reporte_pago.xlsx');
    }
}
