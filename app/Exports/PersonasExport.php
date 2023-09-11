<?php

namespace App\Exports;

use App\Models\Persona;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class PersonasExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return Persona::select('nombre', 'apellido', 'cedula', 'telefono', 'email', 'fechaNacimiento', 'genero')->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Apellido',
            'Cédula',
            'Teléfono',
            'Correo Electrónico',
            'Fecha de Nacimiento',
            'Género',
        ];
    }
}
