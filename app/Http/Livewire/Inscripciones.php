<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Persona;
use App\Models\Temporada;
use App\Models\Categoria;
use Livewire\WithPagination;
use DateTime;
use Livewire\Rules\Required;

class Inscripciones extends Component
{

    use WithPagination;
    public $textoBuscar;
    
    public $jugadores=[];
    public $categorias=[];
    public $temporadas=[];
    public $inscripciones=[];

    public $inscripcion_id;
    public $persona_id;
    public $categoria_id;
    public $temporada_id;
    public $observacion;
    public $anoNacimiento;

    public $modal = false;

    public function render()
    {
        $this->inscripciones = Inscripcion::all();
        $this->jugadores = Persona::all();
        $this->categorias = Categoria::all();
        $this->temporadas = Temporada::all();

        // return view('livewire.inscripciones', [
        //     'inscripciones' => Inscripcion::where("nombre", "like", "%".$this->textoBuscar."%" )->paginate(5)
        // ]);
        return view('livewire.inscripciones', [
            'inscripciones' => Inscripcion::paginate(5)
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
        $this->inscripcion_id = null;  
        $this-> persona_id= ''; 
        $this-> categoria_id= '';  
        $this-> temporada_id= '';  
        $this-> observacion= ''; 
    }
    public function editar($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $this->inscripcion_id = $inscripcion->id;
        $this->persona_id = $inscripcion->id_persona;
        $this->categoria_id = $inscripcion->id_categoria;
        $this->temporada_id =$inscripcion->id_temporada;
        $this->observacion =$inscripcion->observacion;
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Inscripcion::find($id)->delete();
        session()->flash('message', 'Inscripcion eliminada correctamente');
    }

    public function guardar()
    {
        $inscripcion = null;
        $this->validate();
        if($this->temporada_id == '' || $this->categoria_id == '' || $this->persona_id == '')
        {
            session()->flash('message_modal', 'Falta de seleccionar: Temporada o Categoria o Jugador');
            return;
        }

        if(is_null($this->inscripcion_id))
        {
            Inscripcion::create(
            [
                'id_temporada'=> $this->temporada_id,
                'id_categoria'=> $this->categoria_id,
                'id_persona'=> $this->persona_id,
                'observacion'=> $this->observacion                
            ]);    
        }
        else
        {
            $inscripcion = Inscripcion::find($this->inscripcion_id);
            $inscripcion->id_temporada = $this->temporada_id;
            $inscripcion->id_categoria = $this->categoria_id;
            $inscripcion->id_persona = $this->persona_id;
            $inscripcion->observacion = $this->observacion;
            $inscripcion->save();
        }
        
         session()->flash('message',
            $this->inscripcion_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    public function cambioTemporada()
    {
        session()->flash('message', $this->temporada_id ? '¡Cambiaste de temporada!' : '¡Se debe buscar las categorias!');
        $categorias = Inscripcion::where('id_temporada', $this->temporada_id)->groupBy('id_categoria');
        $jugador= Persona::find(1);
        // $fecha1 = date_create($jugador->fechaNacimiento);
        // $fecha2 = date_create(now());
        // $valor = date_diff($fecha1, $fecha2)->format('%R%Y') * 1;
    }

    public function getAnoNacimiento($jugadorId)
    {
        $jugador = Persona::find($jugadorId);
        
        if ($jugador) {
            $fechaNacimiento = new DateTime($jugador->fechaNacimiento);
            return $fechaNacimiento->format('Y');
        }

        return null;
    }

    public function rules()
    {
        return [
            'temporada_id' => ['required'],
            'categoria_id' => ['required'],
            'persona_id' => ['required'],
            'observacion' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'temporada_id.required' => 'El campo Temporada es obligatorio.',
            'categoria_id.required' => 'El campo Categoría es obligatorio.',
            'persona_id.required' => 'El campo Jugador es obligatorio.',
        ];
    }
    
}

