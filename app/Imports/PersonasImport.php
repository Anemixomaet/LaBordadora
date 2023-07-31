<?php

namespace App\Imports;

use App\Models\Persona;
use Maatwebsite\Excel\Concerns\ToModel;

class PersonasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Persona([
            'nombre' => $row[0],
            'apellido' => $row[1],
            'cedula' => $row[2],
            'telefono' => $row[3],
            'email' => $row[4],
            'fechaNacimiento' => $row[5],
            'genero' => $row[6],
        ]);
    }
}
