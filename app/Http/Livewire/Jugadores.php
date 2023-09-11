<?php

namespace App\Http\Livewire;

use App\Exports\PersonasExport;
use Livewire\Component;
use App\Models\Persona;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonasImport;
use Illuminate\Database\QueryException;
use PDF;

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

    public $archivo;

    public $modal = false;
    public $modalArchivo = false;

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
        $this->resetValidation();
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
        try {
            Persona::find($id)->delete();
            session()->flash('message', 'Jugador eliminado correctamente');
        } catch (QueryException $e) {
            session()->flash('message', 'No se puede eliminar el jugador ya que actualmente esta inscrito en alguna categoria.');
        }
        // Persona::find($id)->delete();
        // session()->flash('message', 'Jugador eliminado correctamente');
    }

    public function guardar()
    { 

        $this->validate();
        $person = null;
        $imagenUrl = '';
        if(is_null($this->persona_id))
        {
            // if($this->nombre == "")
            // {
            //     session()->flash('message_modal', 'Por favor ingresar nombre');
            //     return;
            // }
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

    public function calcularEdad($fechaNacimiento)
    {
        $fechaNac = Carbon::createFromFormat('Y-m-d', $fechaNacimiento);
        $edad = $fechaNac->diffInYears(Carbon::now());
        return $edad;
    }

    public function boot()
    {
        Validator::extend('validate_cedula', function ($attribute, $value, $parameters, $validator) {
            // Verificar que la cédula tenga el formato correcto (10 dígitos numéricos)
            if (!preg_match("/^[0-9]{10}$/", $value)) {
                return false;
            }

            // Verificar el dígito de verificación utilizando el algoritmo adecuado para Ecuador
            $cedulaSinDigito = substr($value, 0, 9);
            $digitoVerificacion = substr($value, -1);
            $coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
            $suma = 0;

            for ($i = 0; $i < 9; $i++) {
                $valor = $cedulaSinDigito[$i] * $coeficientes[$i];
                $suma += ($valor >= 10) ? $valor - 9 : $valor;
            }

            $verificacionCalculada = ($suma % 10 === 0) ? 0 : 10 - ($suma % 10);

            return $verificacionCalculada == $digitoVerificacion;
        });
    }

    public function rules()
    {
    return [
        'nombre' => 'required|string',
        'apellido' => 'required|string',
        'cedula' => 'required|string|validateCedula',
        'telefono' => 'required|string',
        'email' => 'required|email',
        'fechaNac' => 'required|date',
        'imagen' => 'max:2048',
        'genero' => 'required|string',
    ];
    }

    public function messages()
    {
    return [
        'nombre.required' => 'El campo Nombre es obligatorio.',
        'apellido.required' => 'El campo Apellido es obligatorio.',
        'cedula.required' => 'El campo Cédula es obligatorio.',
        'cedula.unique' => 'La cédula ingresada ya existe en la base de datos.',
        'cedula.validate_cedula' => 'La cédula ingresada no es válida.', 
        'email.email' => 'El formato del correo electrónico no es válido.',
        'fechaNac.required' => 'La fecha es obligatoria.',
        'telefono.required' => 'Ingrese su número de celular.',
        'imagen.required' => 'Favor cargue una imagen.',
        'genero.required' => 'Favor seleccion un género.',

        ];
    }

    
    public function cargarArchivo()
    {
        $this->abrirModalArchivo();
    }

    public function importarJugadores()
    {
        $this->validate([
            'archivo' => 'required|mimes:xlsx'
        ]);

        Excel::import(new PersonasImport, $this->archivo);

        $this->cerrarModalArchivo();

        session()->flash('message', '¡Datos importados exitosamente!');
    }

    public function abrirModalArchivo()
    {
        $this->modalArchivo = true;
    }

    public function cerrarModalArchivo()
    {
        $this->modalArchivo = false;
    }

    public function generarPDF()
    {
        $datos = Persona::get();  
        $pdfContent = PDF::loadView('livewire.reporte.personas-pdf', compact('datos'))->setPaper('a4', 'landscape')->output();
        return response()->streamDownload(
            function () use ($pdfContent){
                echo $pdfContent;
            }, "reporte_personas.pdf"
        );
    }
        public function generarExcelPersonas()
    {
        $export = new PersonasExport();

        return Excel::download($export, 'reporte_personas.xlsx');
    }
}
