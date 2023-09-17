<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Asistencia;
use App\Models\Persona;
use App\Models\Temporada;
use App\Models\Categoria;
use App\Models\Inscripcion;

class Asistencias extends Component
{
    public $textoBuscar;

    public $temporadas;
    public $categorias;
    public $personas = [];
    public $personas_presentes = [];
    
    //datos de asistencia
    public $asistencia_id;
    public $fecha;
    public $asistencia;

    //Datos de persona
    public $person_id;
    public $temporada_id;
    public $categoria_id;
    
    public $modal = false;

    public function render()
    {
        $this->temporadas = Temporada::all();
        $this->categorias = Categoria::all();
        // $this->asistencias = Asistencia::all();
        return view('livewire.asistencias', [
            // 'asistencias' => Asistencia::where("nombre", "like", "%".$this->textoBuscar."%" )->paginate(5)
            'asistencias' => Asistencia::paginate(5)
        ]);    
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
        $this->asistencia_id = null;
        $this->fecha = '';  
        $this->person_id= '';    
    }

    public function editar($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $this->temporada_id = $asistencia->id_temporada;
        $this->categoria_id = $asistencia->id_categoria; 
        $this->asistencia_id = $asistencia->id;
        $time = strtotime($asistencia->fecha);
        $this->fecha = date('Y-m-d',$time);

        $personasAsistieron = Asistencia::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->get();
        // dd($personasAsistieron);
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Asistencia::find($id)->delete();
        session()->flash('message', 'Asistencia eliminada correctamente');
    }

    public function guardar()
    {
        $asistencia = null;

        if(is_null($this->asistencia_id))
        {            
            foreach($this->personas_presentes as $ppre)
            {
                $inscripcion = Inscripcion::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->where('id_persona',$ppre) ->first();
                //dd($inscripcion);
                Asistencia::create(
                [
                    'id_temporada'=> $this->temporada_id,
                    'id_categoria'=> $this->categoria_id,
                    'id_inscripcion'=> $inscripcion->id,
                    'id_persona'=> $ppre,
                    'asistencia' => 'Asistio',
                    'fecha' => $this->fecha                    
                ]);    
            }  
        }
        else
        {
            $person = Asistencia::find($this->asistencia_id);
            $person->asistencia = $this->asistencia;
            $person->id_persons = $this->person_id;
            $person->save();
        }
        
         session()->flash('message',
            $this->asistencia_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    // public function tiposPersonas()
    // {
    //     $this->tiposPersonas = 'tecnico';
    // }
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
        //dd($personas);
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
        // dd(var_dump($this->personas)); 
    }
}
