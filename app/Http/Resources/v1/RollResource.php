<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class RollResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $valor = $this->value1 + $this->value2;
        $ganador = ($valor > 7)? true: false;
        return [
            'valor1' => $this->value1,
            'valor2' => $this->value2,
            'ganador' => $ganador,
            'email' => $this->user->email,
            // 'jugador' => [
            //     'nombre' => $this->user->name,
            //     'email' => $this->user->email
            // ]


        ];
    }
}
