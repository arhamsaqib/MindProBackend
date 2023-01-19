<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminJudgeResource extends JsonResource
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
            'judgeId'           => $this->judgeId,
            'userId'            => $this->userId,
            'violations'        => 0,
            // 'feedback'          => FeedbackResource::collection($this->feedback),
            'feedback'          => [],
        ];

        return $data;
    }
}
