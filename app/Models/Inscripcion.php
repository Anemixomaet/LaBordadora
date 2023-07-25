<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';
    protected $fillable = ['id','id_temporada','id_categoria', 'id_persona', 'observacion'];

    public function categorias() 
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function personas() 
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
    public function temporada() 
    {
        return $this->belongsTo(Temporada::class, 'id_temporada');
    }
    
}
