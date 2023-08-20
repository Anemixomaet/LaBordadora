<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use PDF;

class Usuarios extends Component
{
    use WithPagination;

    public $textoBuscar;
    public $buscar;
    public $roles;
    public $edad;
    
    //datos de usuario
    public $persona_id;
    public $rol_id;
    public $nombre;
    public $email;
    public $generos=['M'=>'Masculino','F'=>'Femenino','O'=>'Otro'];

    public $modal = false;

    public function render()
    {
        $this->roles = Role::all();
        // $this->buscar = "%".$this->textoBuscar."%";
        return view('livewire.usuarios', [
            'usuarios' => User::where('name', 'like', '%'.$this->textoBuscar.'%' )
                                ->orWhere('email', 'like', '%'.$this->textoBuscar.'%')->paginate(5)
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
        $jugador = User::findOrFail($id);
        $this->persona_id = $jugador->id;
        $this->nombre = $jugador->name;
        $this->email = $jugador->email;
        // $this->apellido = $jugador->apellido;
        // $this->cedula = $jugador->cedula;
        // $this->telefono = $jugador->telefono;        
        // $this->fechaNac = $jugador->fechaNacimiento;
        // $this->imagen =$jugador->imagen;
        // $this->genero =$jugador->genero;

        $this->abrirModal();
    }

    public function borrar($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario eliminado correctamente');
    }

    public function guardar()
    {
        $person = null;
        if(is_null($this->persona_id))
        {
            // Persona::create(
            // [
            //     'nombre' => $this->nombre,
            //     'apellido' => $this->apellido,
            //     'cedula' => $this->cedula,
            //     'telefono'=> $this->telefono,
            //     'email'=> $this->email,
            //     'fechaNacimiento'=>$this->fechaNac,
            //     'imagen'=> $imagenUrl,
            //     'genero'=> $this->genero,
                
            // ]);    
        }
        else
        {
            // $imagenUrl = $this->imagen->store('public');
            // $person = Persona::find($this->persona_id);
            // $person->nombre = $this->nombre;
            // $person->apellido = $this->apellido;
            // $person->cedula = $this->cedula;
            // $person->email = $this->email;
            // $person->fechaNacimiento = $this->fechaNac;
            // $person->imagen = $imagenUrl;
            // $person->genero = $this->genero;
            // $person->save();
        }
        
         session()->flash('message',
            $this->persona_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    public function generarPDF()
    {
        $datos = User::whereHas("roles", function($q){ $q->where("name", "Entrenador"); })->get();  
        $pdfContent = PDF::loadView('livewire.reporte.usuarios-pdf', compact('datos'))->output();
        return response()->streamDownload(
            function () use ($pdfContent){
                echo $pdfContent;
            }, "reporte_personas.pdf"
        );
    }
}
