<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pago;
use App\Models\Persona;
use App\Models\Temporada;
use App\Models\Categoria;
use App\Models\Inscripcion;

class Pagos extends Component
{ 
    public $textoBuscar;

    public $temporadas;
    public $categorias;
    public $personas = [];
    public $personas_presentes = [];
    
    //datos de asistencia
    public $pago_id;
    public $comprobante;
    public $detalle;
    public $fecha;

    //Datos de persona
    public $persona_id;
    public $temporada_id;
    public $categoria_id;
    
    public $modal = false;

    public function render()
    {
        $this->temporadas = Temporada::all();
        $this->categorias = Categoria::all();
        $this->fecha = now()->format('Y-m-d');        
        return view('livewire.pagos', [
            // 'pagos' => Pago::where("nombre", "like", "%".$this->textoBuscar."%" )->paginate(5)
            'pagos' => Pago::paginate(5)
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
        $this->pago_id = null;
        $this->persona_id = null;
        $this->temporada_id = null;
        $this->categoria_id = null;
        $this->fecha = '';  
        $this->comprobante='';
        $this->detalle='';
    }

    public function editar($id)
    {
        $pago = Pago::findOrFail($id);
        $this->pago_id = $pago->id;
        $this->persona_id = $pago->id_persona;
        $this->temporada_id = $pago->id_temporada;
        $this->categoria_id = $pago->id_categoria;         
        $this->fecha = $pago->fecha;
        $this->comprobante = $pago->comprobante;
        $this->detalle = $pago->detalle;

        // $personasAsistieron = Pago::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->get();
        // dd($personasAsistieron);
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Pago::find($id)->delete();
        session()->flash('message', 'Pago eliminada correctamente');
    }

    public function guardar()
    {
        $asistencia = null;

        if(is_null($this->pago_id))
        {            
            // foreach($this->personas_presentes as $ppre)
            // {
                $inscripcion = Inscripcion::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->where('id_persona',$this->persona_id) ->first();
                //dd($inscripcion);
                Pago::create(
                [
                    'id_temporada'=> $this->temporada_id,
                    'id_categoria'=> $this->categoria_id,
                    'id_inscripcion'=> $inscripcion->id,
                    'id_persona'=> $this->persona_id,
                    'comprobante' => $this->comprobante,
                    'detalle' => $this->detalle,
                    'fecha' => $this->fecha
                ]);    
            // }  
        }
        else
        {
            $pago = Pago::find($this->pago_id);
            $pago->id_temporada = $this->temporada_id;
            $pago->id_categoria = $this->categoria_id;
            // $pago->id_inscripcion = $this->person_id;
            $pago->id_persona = $this->persona_id;
            $pago->comprobante = $this->comprobante;
            $pago->detalle = $this->detalle;
            $pago->fecha = $this->fecha;
            $pago->save();
        }
        
         session()->flash('message',
            $this->pago_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }
    
    public function cambioTemporada()
    {
        if($this->temporada_id == '' || $this->categoria_id == '')
        {
            return;
        }
        
        $inscripciones = Inscripcion::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->get();
        $this->personas = [];
        foreach($inscripciones as $incripcion)
        {
            $this->personas[] = Persona::find($incripcion->id_persona);
        }
        //dd($this->personas); 
    }

    public function cambioCategoria()
    {
        if($this->temporada_id == '' || $this->categoria_id == '')
        {
            return;
        }        
        $inscripciones = Inscripcion::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->get();
        $this->personas = [];
        foreach($inscripciones as $incripcion)
        {
            $this->personas[] = Persona::find($incripcion->id_persona);
        }
        //dd($this->personas);
        //  dd(var_dump($this->personas)); 
    }
}

