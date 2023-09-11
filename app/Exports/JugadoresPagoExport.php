<?php

namespace App\Exports;

use App\Models\Pago;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JugadoresPagoExport implements FromCollection, WithHeadings
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
        $jugadores = Pago::rightjoin('inscripciones', 'inscripciones.id', '=', 'pagos.id_inscripcion')
            ->leftJoin('personas', 'personas.id', '=', 'inscripciones.id_persona')
            ->leftJoin('temporadas', 'inscripciones.id_temporada', '=', 'temporadas.id')
            ->leftJoin('categorias', 'inscripciones.id_categoria', '=', 'categorias.id')
            ->select('temporadas.detalle as Temporada', 'categorias.nombre as Categoria', 'personas.nombre', 'personas.apellido', 'pagos.fecha', 'pagos.detalle')
            ->where('inscripciones.id_categoria', '=', $this->categoria)
            ->where('inscripciones.id_temporada', '=', $this->temporada)
            ->whereYear('pagos.fecha', '=', date('Y', strtotime($this->fecha)))
            ->whereMonth('pagos.fecha', '=', date('m', strtotime($this->fecha)))
            ->get();

        return $jugadores;
    }

    public function headings(): array
    {
        return [
            'Temporada',
            'Categoria',
            'Nombre',
            'Apellido',
            'Fecha',
            'Detalle',
        ];
    }
}
