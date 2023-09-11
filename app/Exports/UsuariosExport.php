<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Importa esta interfaz
use App\User;
use Spatie\Permission\Models\Role;

class UsuariosExport implements FromCollection, WithHeadings // Agrega la interfaz
{
    protected $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    public function collection()
    {
        return $this->datos;
    }

    // Define las cabeceras
    public function headings(): array
    {
        return [
            'Nombre',
            'Correo electrónico',
            'Cédula',
            'Teléfono',
            'Fecha Nacimiento',
            'Genero',
            // 'Roles'
        ];
    }

}
