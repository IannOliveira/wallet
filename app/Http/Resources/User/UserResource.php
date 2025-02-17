<?php

namespace App\Http\Resources\User;

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
        return [
            'id' => $this->id,
            'primeiro_nome' => $this->primeiro_nome,
            'sobrenome' => $this->sobrenome,
            'cep' => $this->cep,
            'email' => $this->email,
        ];
    }
}
