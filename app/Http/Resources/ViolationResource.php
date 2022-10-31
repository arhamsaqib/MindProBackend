<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ViolationResource extends JsonResource
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
            'userId'          => $this->jid,
            'violationCount' => $this->v_count,
            'firstName'      => $this->fname,
            'lastName'      => $this->lname,
            'avatar'  => $this->avatar,

        ];
        return $data;
    }
}
