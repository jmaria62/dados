<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       
        //$valor = $this->value1 + $this->value2;
        //$ganador = ($valor > 7)? true: false;
        return [
            'name' => $this->name,
            'email' => $this->email,
            //'ganador' => $ganador,


        ];
    }
}
