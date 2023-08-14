<?php

namespace App\Http\Livewire;

use Livewire\Component;
use PDF;
use App\Models\Inscripcion;


class ReporteJugadoresCategoria extends Component
{
    public function render()
    {
        $jugadores = Inscripcion::join('categorias', 'categorias.id', '=', 'inscripciones.id_categoria')
                    ->join('personas', 'personas.id', '=', 'inscripciones.id_persona')
                    ->select('personas.nombre as nombre', 'personas.apellido as apellido', 'categorias.nombre as categoria', 'personas.cedula as cedula', 'personas.email as email')
                    ->get();
        return view('livewire.reporte.jugadores-categoria', compact('jugadores') );
    }
    
    public function generarPDF()
    {
        $jugadores = Inscripcion::join('categorias', 'categorias.id', '=', 'inscripciones.id_categoria')
                    ->join('personas', 'personas.id', '=', 'inscripciones.id_persona')
                    ->select('personas.nombre as nombre', 'personas.apellido as apellido', 'categorias.nombre as categoria', 'personas.cedula as cedula', 'personas.email as email')
                    ->get()->toArray();        

        $pdfContent = PDF::loadView('livewire.reporte.jugadores-categoria-pdf', compact('jugadores'))->output();
        
        return response()->streamDownload(
            function () use ($pdfContent){
                echo $pdfContent;
            }, "filename.pdf"
        );
    }
}
