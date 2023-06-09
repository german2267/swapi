<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanetResource extends JsonResource {

    public function toArray($request) {

        return [
            'Nombre'            => $this['name'],
            'Periodo_rotacion'  => $this['rotation_period'],
            'Periodo_orbital'   => $this['orbital_period'],
            'Diametro'          => $this['diameter'],
            'Clima'             => $this['climate'],
            'Gravedad'          => $this['gravity'],
            'Terreno'           => $this['terrain'],
            'Superficie_acuosa' => $this['surface_water'],
            'Poblacion'         => $this['population'],
            'Residentes'        => $this['residents'],
            'Peliculas'         => $this['films'],
            'Creado'            => $this['created'],
            'Editado'           => $this['edited'],
            'Url'               => $this['url'],
        ];
    }
}
