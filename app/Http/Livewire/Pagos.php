<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pago;
use App\Models\Persona;
use App\Models\Temporada;
use App\Models\Categoria;
use App\Models\Inscripcion;
use Livewire\WithFileUploads;


class Pagos extends Component
{ 
    public $textoBuscar;
    use WithFileUploads;

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
        //$this->fecha = now()->format('Y-m-d');
        
        // Usar paginate() para obtener resultados paginados
        $pagos = Pago::paginate(5);

        return view('livewire.pagos', ['pagos' => $pagos]);
        // $this->temporadas = Temporada::all();
        // $this->categorias = Categoria::all();
        // $this->fecha = now()->format('Y-m-d');        
        // return view('livewire.pagos', [
        //     // 'pagos' => Pago::where("nombre", "like", "%".$this->textoBuscar."%" )->paginate(5)
        //     'pagos' => Pago::paginate(5)
        // ]);
        
        // $this->temporadas = Temporada::all();
        // $this->categorias = Categoria::all();
        // $this->fecha = now()->format('Y-m-d');
    
        // $query = Pago::query();
    
        // if ($this->textoBuscar) {
        //     $query->where('nombre', 'like', '%' . $this->textoBuscar . '%');
        // }
    
        // $pagos = $query->paginate(5);
    
        // return view('livewire.pagos', [
        //     'pagos' => $pagos,
        // ]);
    }

    public function updatingTextoBuscar()
    {
        $this->resetPage();
    }
    
    public function resetPage()
    {
        $this->reset('page');
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

    // public function guardar()
    // {
    //     $asistencia = null;
    //     $imagenUrl = '';

    //     if(is_null($this->pago_id))
    //     {            
    //         // foreach($this->personas_presentes as $ppre)
    //         // {
    //             $inscripcion = Inscripcion::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->where('id_persona',$this->persona_id) ->first();
    //             //dd($inscripcion);
    //             $imagenUrl = $this->comprobante->store('public');
    //             Pago::create(
    //             [
    //                 'id_temporada'=> $this->temporada_id,
    //                 'id_categoria'=> $this->categoria_id,
    //                 'id_inscripcion'=> $inscripcion->id,
    //                 'id_persona'=> $this->persona_id,
    //                 'comprobante' => $imagenUrl,
    //                 'detalle' => $this->detalle,
    //                 'fecha' => $this->fecha
    //             ]);    
    //         // }  
    //     }
    //     else
    //     {
    //         $imagenUrl = $this->imagen->store('public');
    //         $pago = Pago::find($this->pago_id);
    //         $pago->id_temporada = $this->temporada_id;
    //         $pago->id_categoria = $this->categoria_id;
    //         // $pago->id_inscripcion = $this->person_id;
    //         $pago->id_persona = $this->persona_id;
    //         $pago->comprobante = $imagenUrl;
    //         $pago->detalle = $this->detalle;
    //         $pago->fecha = $this->fecha;
    //         $pago->save();
    //     }
        
    //      session()->flash('message',
    //         $this->pago_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
    //      $this->cerrarModal();
    //      $this->limpiarCampos();
    // }

    public function guardar()
    {
        $this->validate();
        $asistencia = null;
        $imagenUrl = '';
    
        if (is_null($this->pago_id)) {
            $inscripcion = Inscripcion::where('id_temporada', $this->temporada_id)->where('id_categoria', $this->categoria_id)->where('id_persona', $this->persona_id)->first();
    
            // Verifica si se proporcionó un archivo antes de intentar almacenarlo
            if ($this->comprobante) {
                $imagenUrl = $this->comprobante->store('public');
            }
    
            Pago::create([
                'id_temporada' => $this->temporada_id,
                'id_categoria' => $this->categoria_id,
                'id_inscripcion' => $inscripcion->id,
                'id_persona' => $this->persona_id,
                'comprobante' => $imagenUrl, // Almacena la URL temporal si se proporciona un archivo
                'detalle' => $this->detalle,
                'fecha' => $this->fecha,
            ]);
        } else {
            // Resto del código de actualización
        }
    
        session()->flash('message', $this->pago_id ? '¡Actualización exitosa!' : '¡Se creó un nuevo registro!');
    
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

    public function rules()
    {
        return [
            'temporada_id' => 'required',
            'categoria_id' => 'required',
            'fecha' => 'required|date',
            'detalle' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'temporada_id.required' => 'El campo Temporada es obligatorio.',
            'categoria_id.required' => 'El campo Categoría es obligatorio.',
            'fecha.required' => 'El campo Fecha es obligatorio.',
            'fecha.date' => 'El campo Fecha debe ser una fecha válida.',
            'detalle.required' => 'El campo Detalle es obligatorio.',
        ];
    }

}

