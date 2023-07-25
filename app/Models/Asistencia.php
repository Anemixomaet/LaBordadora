<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencias';
    protected $fillable = ['id','id_temporada','id_categoria', 'id_persona', 'id_inscripcion', 'asistencia', 'fecha'];

    public function persona() 
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function temporada()
    {
        return $this->belongsTo(Temporada::class, 'id_temporada');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'id_inscripcion');
    }

}
