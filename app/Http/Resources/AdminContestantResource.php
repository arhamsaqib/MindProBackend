<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminContestantResource extends JsonResource
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
            'status'            => $this->status,
            'userSince'         => $this->created_at,
            'firstName'         => $this->fname,
            'lastName'          => $this->lname,
            'avatar'            => $this->avatar,
            'country'           => $this->country,
            'city'              => $this->city,
            'contestantId'           => $this->contestantId,
            'userId'            => $this->userId,
            'violations'        => 0,
            'feedback'          => []
        ];
        return $data;
    }
}
