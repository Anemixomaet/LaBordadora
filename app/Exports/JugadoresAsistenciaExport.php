<?php
namespace App\Exports;

use App\Models\Asistencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JugadoresAsistenciaExport implements FromCollection, WithHeadings
{
    private $categoria;
    private $temporada;
    private $fecha;

    public function __construct($categoria, $temporada, $fecha)
    {
        $this->categoria = $categoria;
        $this->temporada = $temporada;
        $this->fecha = $fecha;
    }

    public function collection()
    {
        return Asistencia::rightjoin('inscripciones', 'inscripciones.id', '=', 'asistencias.id_inscripcion')
            ->leftJoin('personas', 'personas.id', '=', 'inscripciones.id_persona')
            ->leftJoin('temporadas', 'inscripciones.id_temporada', '=', 'temporadas.id')
            ->leftJoin('categorias', 'inscripciones.id_categoria', '=', 'categorias.id')
            ->select('temporadas.detalle as Temporada', 'categorias.nombre as Categoria', 'asistencias.asistencia', 'personas.nombre', 'personas.apellido', 'asistencias.fecha')
            ->where('inscripciones.id_categoria', '=', $this->categoria)
            ->where('inscripciones.id_temporada', '=', $this->temporada)
            ->where('asistencias.fecha', '=', date('Y-m-d', strtotime($this->fecha)))
            ->get();
    }

    public function headings(): array
    {
        return [
            'Temporada',
            'Categoria',
            'Asistencia',
            'Nombre',
            'Apellido',
            'Fecha',
        ];
    }
}