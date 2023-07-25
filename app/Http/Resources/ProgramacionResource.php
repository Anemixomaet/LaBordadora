<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cliente' => $this->cliente,
            'tarea' => $this->tarea,
            'fecha' => $this->fecha,
            'tiempo_inicio' => $this->tiempo_inicio,
            'tiempo_fin' => $this->tiempo_fin,
            'estado' => $this->estado,
        ];
    }
}
