<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource {

    public function toArray($request) {

        return [
            'Nombre'      => $this['name'],
            'Peso'        => $this['height'],
            'Masa'        => $this['mass'],
            'Color_pelo'  => $this['hair_color'],
            'Color_piel'  => $this['skin_color'],
            'Color_ojos'  => $this['eye_color'],
            'Cumpleaños'  => $this['birth_year'],
            'Genero'      => $this['gender'],
            'HomeWorld'   => $this['homeworld'],
            'Peliculas'   => $this['films'],
            'Especies'    => $this['species'],
            'Vehiculos'   => $this['vehicles'],
            'Naves'       => $this['starships'],
            'Creado'      => $this['created'],
            'Editado'     => $this['edited'],
            'Url'         => $this['url'],
        ];
    }
}
