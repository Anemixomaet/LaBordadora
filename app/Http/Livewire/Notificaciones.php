<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inscripcion;
use App\Models\Persona;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;
use App\Mail\InasistenciaCorreo;
use App\Mail\PagoCorreo;

class Notificaciones extends Component
{
    use WithPagination;
    public $textoBuscar;
    
    public $inscripcion_id;
    public $persona_id;
    public $categoria_id;
    public $temporada_id;
    public $observacion;

    public $modal = false;
    public $persona;

    public function render()
    {   
        return view('livewire.notificaciones', [
            'notificaciones' => Inscripcion::join('personas', 'personas.id', '=', 'inscripciones.id_persona')
                                ->where("personas.nombre", "like", "%".$this->textoBuscar."%" )->paginate(5)
        ]);
    }
    
    public function updatingTextoBuscar()
    {
        $this->resetPage();
    }

    // public function inasistencia($id)
    // {
    //     $inscripcion = Inscripcion::find($id);
    //     $persona = Persona::find($inscripcion->id_persona);
    //     Mail::to($persona->email)
    //     ->send(new InasistenciaCorreo($persona));
    //     session()->flash('message', 'Correo de inasistencia enviado correctamente');
    // }

    public function inasistencia($id)
{
    $inscripcion = Inscripcion::find($id);

    // Verifica si se encontró una inscripción válida
    if ($inscripcion) {
        $persona = Persona::find($inscripcion->id_persona);

        // Verifica si se encontró una persona válida
        if ($persona) {
            Mail::to($persona->email)
                ->send(new InasistenciaCorreo($persona));
            session()->flash('message', 'Correo de inasistencia enviado correctamente');
        } else {
            // Maneja el caso en el que no se encontró una persona válida
            session()->flash('error', 'No se encontró la persona asociada a esta inscripción');
        }
    } else {
        // Maneja el caso en el que no se encontró una inscripción válida
        session()->flash('error', 'No se encontró la inscripción correspondiente');
    }
}

    public function pago($id)
    {
        $inscripcion = Inscripcion::find($id);
        $this->persona = Persona::find($inscripcion->id_persona);
        Mail::to($this->persona ->email)
        ->send(new PagoCorreo($this->persona ));
        session()->flash('message', 'Correo de pago enviado correctamente');
    }

    public function mensaje($id)
    {
        $inscripcion = Inscripcion::find($id);
        $persona = Persona::find($inscripcion->id_persona);
        redirect()->to('https://wa.me/'.$persona->telefono.'?text=Hola queremos informarte');
    }
}
