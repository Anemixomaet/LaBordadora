<?php

namespace App\Http\Livewire;

use Livewire\Component;
use PDF;
use App\Models\Inscripcion;
use App\Models\Categoria;
use App\Models\Temporada;

class ReporteJugadoresCategoria extends Component
{
    public $nombre = '';
    public $cedula = '';
    public $categoria = 0;

    public $categorias;

    public function render()
    {
        $this->categorias = Categoria::all();
        $jugadores = Inscripcion::join('categorias', 'categorias.id', '=', 'inscripciones.id_categoria')
                    ->join('personas', 'personas.id', '=', 'inscripciones.id_persona')
                    ->select('personas.nombre as nombre', 'personas.apellido as apellido', 'categorias.nombre as categoria', 'personas.cedula as cedula', 'personas.email as email')
                    ->where('personas.nombre','like','%'.$this->nombre.'%')
                    ->where('personas.cedula','like','%'.$this->cedula.'%')
                    ->where('categorias.id',$this->categoria)
                    ->get();
        return view('livewire.reporte.jugadores-categoria', compact('jugadores') );
    }
    
    public function generarPDF()
    {
        $jugadores = Inscripcion::join('categorias', 'categorias.id', '=', 'inscripciones.id_categoria')
                    ->join('personas', 'personas.id', '=', 'inscripciones.id_persona')
                    ->select('personas.nombre as nombre', 'personas.apellido as apellido', 'categorias.nombre as categoria', 'personas.cedula as cedula', 'personas.email as email')
                    ->where('personas.nombre','like','%'.$this->nombre.'%')
                    ->where('personas.cedula','like','%'.$this->cedula.'%')
                    ->where('categorias.id',$this->categoria)
                    ->get()
                    ->toArray();        

        $pdfContent = PDF::loadView('livewire.reporte.jugadores-categoria-pdf', compact('jugadores'))->output();
        
        return response()->streamDownload(
            function () use ($pdfContent){
                echo $pdfContent;
            }, "reporte_categoria.pdf"
        );
    }
}
