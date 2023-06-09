<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource {

    public function toArray($request) {

        return [
            'Nombre'           => $this['name'],
            'Modelo'           => $this['model'],
            'Creador'          => $this['manufacturer'],
            'Costo_en_creditos'=> $this['cost_in_credits'],
            'Max_velocidad_atm'=> $this['max_atmosphering_speed'],
            'Tripulacion'      => $this['crew'],
            'Pasajeros'        => $this['passengers'],
            'Capacidad_carga'  => $this['cargo_capacity'],
            'Comentibles'      => $this['consumables'],
            'Clase_vehiculo'   => $this['vehicle_class'],
            'Pilotos'          => $this['pilots'],
            'Peliculas'        => $this['films'],
            'Creado'           => $this['created'],
            'Editado'          => $this['edited'],
            'Url'              => $this['url'],
        ];
    }
}
