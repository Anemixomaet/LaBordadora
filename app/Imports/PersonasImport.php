<?php

namespace App\Imports;

use App\Models\Persona;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Persona([
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'cedula' => $row['cedula'],
            'telefono' => $row['telefono'],
            'email' => $row['email'],
            'fechaNacimiento' => $row['fechanacimiento'],
            'genero' => $row['genero'],
            'imagen' => $row['imagen'],
        ]);
    }
}
