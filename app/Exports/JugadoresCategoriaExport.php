<?php
namespace App\Exports;

use App\Models\Inscripcion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JugadoresCategoriaExport implements FromCollection, WithHeadings
{
    private $nombre;
    private $cedula;
    private $categoria;

    public function __construct($nombre, $cedula, $categoria)
    {
        $this->nombre = $nombre;
        $this->cedula = $cedula;
        $this->categoria = $categoria;
    }

    public function collection()
    {
        $jugadores = Inscripcion::join('categorias', 'categorias.id', '=', 'inscripciones.id_categoria')
            ->join('personas', 'personas.id', '=', 'inscripciones.id_persona')
            ->select('personas.nombre as Nombre', 'personas.apellido as Apellido', 'categorias.nombre as Categoria', 'personas.cedula as Cedula', 'personas.email as Email')
            ->where('personas.nombre', 'like', '%' . $this->nombre . '%')
            ->where('personas.cedula', 'like', '%' . $this->cedula . '%')
            ->where('categorias.id', $this->categoria)
            ->get();

        return $jugadores;
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Apellido',
            'Categoria',
            'Cedula',
            'Email',
        ];
    }
}
