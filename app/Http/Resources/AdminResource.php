<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($array)
    {
        $data = [
            'username'          => $this->username,
            'email'             => $this->email,
            'id'            => $this->id,
            'createdAt'         => $this->created_at,
            'role'         => $this->role,
        ];
        return $data;
    }
}
