<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Temporada;
use Illuminate\Database\QueryException;
use PDF;

class Temporadas extends Component
{
    public $textoBuscar;

    public $temporada_id;
    public $nombre;
    public $detalle;

    public $modal = false;

    public function render()
    {
        return view('livewire.temporadas', [
            'temporadas' => Temporada::where("nombre", "like", "%".$this->textoBuscar."%" )->paginate(5)
        ]);
    }

    public function updatingTextoBuscar()
    {
        $this->resetPage();
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->abrirModal();        
    }

    public function abrirModal()
    {
        $this->modal = true;
    }

    public function cerrarModal(){
        $this->modal = false;
    }

    public function limpiarCampos()
    {
        $this->temporada_id = null;
        $this->nombre = '';
        $this->detalle = '';       
    }

    public function editar($id)
    {
        $temporada = Temporada::findOrFail($id);
        $this->temporada_id = $temporada->id;
        $this->nombre = $temporada->nombre;
        $this->detalle = $temporada->detalle;

        $this->abrirModal();
    }

    public function borrar($id)
    {
        try{
            Temporada::find($id)->delete();
            session()->flash('message', 'Temporada eliminada correctamente');
        }catch (QueryException $e) {
            session()->flash('message', 'No se puede eliminar la temporada ya que existen jugadores inscritos.');
        }        
    }

    public function guardar()
    {
        $temporada = null;

        if(is_null($this->temporada_id))
        {
            Temporada::create(
            [
                'nombre' => $this->nombre,
                'detalle' => $this->detalle,
                
            ]);    
        }
        else
        {
            $temporada = Temporada::find($this->temporada_id);
            $temporada->nombre = $this->nombre;
            $temporada->detalle = $this->detalle;
            $temporada->save();
        }
        
         session()->flash('message',
            $this->temporada_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }
    
    public function generarPDF()
    {
        $datos = Temporada::get();
        $pdfContent = PDF::loadView('livewire.reporte.temporadas-pdf', compact('datos'))->output();
        return response()->streamDownload(
            function () use ($pdfContent){
                echo $pdfContent;
            }, "reporte_temporadas.pdf"
        );
    }
}
