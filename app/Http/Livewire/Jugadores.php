<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persona;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Jugadores extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $textoBuscar;
    public $buscar;
    public $categorias;
    public $edad;
    
    //datos de jugador
    public $persona_id;
    public $nombre;
    public $apellido;
    public $cedula;
    public $telefono;
    public $email;
    public $fechaNac;
    public $imagen;
    public $genero;
    public $generos=['M'=>'Masculino','F'=>'Femenino','O'=>'Otro'];


    public $modal = false;

    public function render()
    {
        $this->buscar = "%".$this->textoBuscar."%";
        return view('livewire.jugadores', [
            'jugadores' => Persona::where("nombre", "like", "%".$this->textoBuscar."%" )->paginate(5)
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
        $this->persona_id = null;
        $this-> nombre = '';
        $this-> apellido = '';
        $this-> cedula = '';
        $this-> telefono = '';
        $this-> email = '';
        $this-> fechaNac = '';
        $this-> imagen = '';
        $this-> genero ='';      
    }

    public function editar($id)
    {
        $jugador = Persona::findOrFail($id);
        $this->persona_id = $jugador->id;
        $this->nombre = $jugador->nombre;
        $this->apellido = $jugador->apellido;
        $this->cedula = $jugador->cedula;
        $this->telefono = $jugador->telefono;
        $this->email = $jugador->email;
        $this->fechaNac = $jugador->fechaNacimiento;
        $this->imagen =$jugador->imagen;
        $this->genero =$jugador->genero;

        $this->abrirModal();
    }

    public function borrar($id)
    {
        Persona::find($id)->delete();
        session()->flash('message', 'Jugador eliminado correctamente');
    }

    public function guardar()
    { 

        $person = null;
        $imagenUrl = '';
        if(is_null($this->persona_id))
        {
            if($this->nombre == "")
            {
                session()->flash('message_modal', 'Por favor ingresar nombre');
                return;
            }
            $imagenUrl = $this->imagen->store('public');
            Persona::create(
            [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'cedula' => $this->cedula,
                'telefono'=> $this->telefono,
                'email'=> $this->email,
                'fechaNacimiento'=>$this->fechaNac,
                'imagen'=> $imagenUrl,
                'genero'=> $this->genero,
                
            ]);    
        }
        else
        {
            $imagenUrl = $this->imagen->store('public');
            $person = Persona::find($this->persona_id);
            $person->nombre = $this->nombre;
            $person->apellido = $this->apellido;
            $person->cedula = $this->cedula;
            $person->email = $this->email;
            $person->fechaNacimiento = $this->fechaNac;
            $person->imagen = $imagenUrl;
            $person->genero = $this->genero;
            $person->save();
        }
        
         session()->flash('message',
            $this->persona_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }
    
}
