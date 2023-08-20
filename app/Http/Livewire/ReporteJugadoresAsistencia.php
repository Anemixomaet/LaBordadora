<?php

namespace App\Http\Livewire;

use Livewire\Component;
use PDF;
use App\Models\Asistencia;
use App\Models\Categoria;
use App\Models\Temporada;

class ReporteJugadoresAsistencia extends Component
{
    public $nombre = '';
    public $fecha;
    public $categoria = 0;
    public $temporada = 0;

    public $categorias;
    public $temporadas;

    public function render()
    {
        $this->categorias = Categoria::all();
        $this->temporadas = Temporada::all();
        $jugadores = Asistencia::rightjoin('inscripciones', 'inscripciones.id', '=', 'asistencias.id_inscripcion')                    
                    ->leftJoin('personas', 'personas.id', '=', 'inscripciones.id_persona')
                    ->leftJoin('temporadas', 'inscripciones.id_temporada', '=', 'temporadas.id')
                    ->leftJoin('categorias', 'inscripciones.id_categoria', '=', 'categorias.id')
                    ->select('temporadas.nombre as temporada', 'categorias.nombre as categoria', 'asistencias.asistencia', 'personas.nombre', 'personas.apellido', 'asistencias.fecha')
                    ->where('inscripciones.id_categoria','=', $this->categoria)
                    ->where('inscripciones.id_temporada','=', $this->temporada)
                    ->Where('asistencias.fecha','=',date('Y-m-d', strtotime($this->fecha)))
                    ->get();

        return view('livewire.reporte.jugadores-asistencia', compact('jugadores') );
    }
    
    public function generarPDF()
    {
        //dd(date('Y-m-d', strtotime($this->fecha)));
        $jugadores = Asistencia::rightjoin('inscripciones', 'inscripciones.id', '=', 'asistencias.id_inscripcion')                    
                    ->leftJoin('personas', 'personas.id', '=', 'inscripciones.id_persona')
                    ->leftJoin('temporadas', 'inscripciones.id_temporada', '=', 'temporadas.id')
                    ->leftJoin('categorias', 'inscripciones.id_categoria', '=', 'categorias.id')
                    ->select('temporadas.nombre as temporada', 'categorias.nombre as categoria', 'asistencias.asistencia', 'personas.nombre', 'personas.apellido', 'asistencias.fecha')
                    ->where('inscripciones.id_categoria','=', $this->categoria)
                    ->where('inscripciones.id_temporada','=', $this->temporada)
                    ->Where('asistencias.fecha','=',date('Y-m-d', strtotime($this->fecha)))
                    ->get()
                    ->toArray();        

        $pdfContent = PDF::loadView('livewire.reporte.jugadores-asistencia-pdf', compact('jugadores'))->output();
        
        return response()->streamDownload(
            function () use ($pdfContent){
                echo $pdfContent;
            }, "reporte_asistencia.pdf"
        );
    }
}
