<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsuariosExport;
use Illuminate\Support\Facades\View;

class Usuarios extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $textoBuscar;
    public $buscar;
    public $roles;
    public $edad;
    
    //datos de usuario
    public $persona_id;
    public $rol_id;
    public $nombre;
    public $email;
    public $fechaNac;
    public $imagen;
    public $cedula;
    public $telefono;
    public $genero;
    public $generos=['M'=>'Masculino','F'=>'Femenino','O'=>'Otro'];

    public $modal = false;

    public function render()
    {
        $this->roles = Role::all();
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
        $this->resetValidation();
        $this->persona_id = null;
        $this-> nombre = '';
        $this-> email = '';
        $this-> fechaNac = '';
        $this-> imagen = '';
        $this-> cedula = '';
        $this-> telefono = '';
        $this-> genero ='';  
    }

    public function editar($id)
    {
        $usario = User::findOrFail($id);
        $this->persona_id = $usario->id;
        $this->nombre = $usario->name;
        $this->email = $usario->email;
        $this->fechaNac = $usario->fechaNacimiento;
        $this->imagen = $usario->imagen;
        $this->cedula = $usario->cedula;
        $this->telefono = $usario->telefono;
        $this->genero =$usario->genero;

        $this->abrirModal();
    }

    public function borrar($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario eliminado correctamente');
    }

    public function guardar()
    {
        $this->validate();
        $user = null;
        $imagenUrl = '';
        if(is_null($this->persona_id))
        {
            $imagenUrl = $this->imagen;
            $user = User::create([
                'name' => $this->nombre,
                'email' => $this->email,
                'fechaNacimiento'=>$this->fechaNac,
                'profile_photo_path' => $imagenUrl, 
                'password' => bcrypt('password'),
                'cedula' => $this->cedula,
                'telefono'=> $this->telefono,
                'genero'=> $this->genero,
            ]);   
        }
        else
        {
            // $imagenUrl = $this->imagen->store('public');
            $user = User::find($this->persona_id);
            $user->name = $this->nombre;
            $user->email = $this->email;
            $user->fechaNacimiento = $this->fechaNac;
            $user->cedula = $this->cedula;
            $user->telefono = $this->telefono;
            $user->genero = $this->genero;
            // Actualizar la imagen solo si se proporcionó una nueva
            if ($this->imagen instanceof TemporaryUploadedFile) {
                $user->profile_photo_path = $this->imagen->store('public');
            }
            // Actualizar otros campos relacionados con el usuario
            $user->save();
        }
            // Asignar roles al usuario
            if ($this->rol_id) {
                $rol = Role::findOrFail($this->rol_id);
                $user->syncRoles([$rol->id]);
            } else {
                // Si no se seleccionó ningún rol, eliminar todos los roles del usuario
                $user->syncRoles([]);
            }
        
         session()->flash('message',
            $this->persona_id ? '¡Actualización exitosa!' : '¡Se creo un nuevo registro!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }

    // public function calcularEdad($fechaNacimiento)
    // {
    //     $fechaNac = Carbon::createFromFormat('Y-m-d', $fechaNacimiento);
    //     $edad = $fechaNac->diffInYears(Carbon::now());
    //     return $edad;
    // }

    public function asignarRol($id)
    {
        // dd($this->rol_id);
        $usuario = User::findOrFail($id);
        if ($this->rol_id) {
            $rol = Role::findOrFail($this->rol_id);
            $usuario->syncRoles([$rol->id]);
        } else {
            $usuario->syncRoles([]);
        }         
    }

    public function generarPDF()
    {
        $datos = User::all();  
        $pdfContent = PDF::loadView('livewire.reporte.usuarios-pdf', compact('datos'))->setPaper('a4', 'landscape')->output();
        return response()->streamDownload(
            function () use ($pdfContent){
                echo $pdfContent;
            }, "reporte_personas.pdf"
        );
    }

    public function generarExcel()
    {
        $datos = User::with('roles')
            ->select('name', 'email','cedula','telefono','fechaNacimiento','genero')
            ->get()
            ->map(function ($user) {
                $roles = $user->roles->pluck('name')->implode(', '); // Obtener los nombres de los roles
    
                return [
                    'Nombre' => $user->name,
                    'Correo electrónico' => $user->email,
                    'Cédula' => $user->cedula,
                    'Teléfono'=> $user->telefono,
                    'Fecha Nacimiento'=> $user->fechaNacimiento,
                    'Genero'=> $user->genero,
                    'Roles' => $roles, // Agregar los roles a los datos
                ];
            });
    
        return Excel::download(new UsuariosExport($datos), 'reporte_usuarios.xlsx');
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string',
            'email' => 'required|email',
            'fechaNac' => 'required|date',
            'imagen' => 'max:2048',
            'cedula' => 'required|string|validateCedula',
            'telefono' => 'required|string',
            'genero' => 'required|string',
            'rol_id' => 'required', // Asegúrate de que esto sea requerido si estás asignando roles
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'email.required' => 'El campo Correo Electrónico es obligatorio.',
            'email.email' => 'El formato del Correo Electrónico no es válido.',
            'fechaNac.required' => 'El campo Fecha de Nacimiento es obligatorio.',
            // 'imagen.required' => 'El campo Imagen es obligatorio.',
            // 'imagen.image' => 'La Imagen debe ser un archivo de imagen válido.',
            // 'imagen.mimes' => 'La Imagen debe ser de tipo JPEG, PNG, JPG o GIF.',
            'imagen.max' => 'La Imagen no debe superar los 2048 KB.',
            'cedula.required' => 'El campo Cédula es obligatorio.',
            'cedula.unique' => 'La Cédula ingresada ya existe en la base de datos.',
            'cedula.validate_cedula' => 'La Cédula ingresada no es válida.',
            'telefono.required' => 'El campo Teléfono es obligatorio.',
            'genero.required' => 'El campo Género es obligatorio.',
            'rol_id.required' => 'Debes seleccionar al menos un Rol.',
        ];
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


}
