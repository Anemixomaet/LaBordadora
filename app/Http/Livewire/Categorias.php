<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use PDF;
use Illuminate\Database\QueryException;

class Categorias extends Component
{
    public $textoBuscar;
    
    public $categoria_id;
    public $nombre;
    public $detalle;
    

    public $modal = false;

    public function render()
    {
        return view('livewire.categorias', [
            'categorias' => Categoria::where("nombre", "like", "%".$this->textoBuscar."%" )->paginate(5)
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
        $this->categoria_id = null;
        $this->nombre = '';
        $this->detalle = '';       
    }

    public function editar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $this->categoria_id = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->detalle = $categoria->detalle;

        $this->abrirModal();
    }

    public function borrar($id)
    {
        
        Try{
            Categoria::find($id)->delete();
            session()->flash('message', 'Categoria eliminada correctamente');
        } catch (QueryException $e) {
            session()->flash('message', 'No se puede eliminar la categoría ya que esta en uso actualmente.');
        }
    }

    public function guardar()
    {
        $this->validate();

        $categoria = null;

        if (is_null($this->categoria_id)) {
            Categoria::create([
                'nombre' => $this->nombre,
                'detalle' => $this->detalle,
            ]);
        } else {
            $categoria = Categoria::find($this->categoria_id);
            $categoria->nombre = $this->nombre;
            $categoria->detalle = $this->detalle;
            $categoria->save();
        }

        session()->flash('message', $this->categoria_id ? '¡Actualización exitosa!' : '¡Se creó un nuevo registro!');

        $this->cerrarModal();
        $this->limpiarCampos();
    }

    public function generarPDF()
    {
        $datos = Categoria::get();  
        $pdfContent = PDF::loadView('livewire.reporte.categorias-pdf', compact('datos'))->output();
        return response()->streamDownload(
            function () use ($pdfContent){
                echo $pdfContent;
            }, "reporte_categorias.pdf"
        );
    }

    protected $rules = [
        'nombre' => 'required',
        'detalle' => 'required',
    ];
    
    protected $messages = [
        'nombre.required' => 'El campo nombre es obligatorio.',
        'detalle.required' => 'El campo detalle es obligatorio.',
    ];
}
