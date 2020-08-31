<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'reply' => $this->reply,
            'user' => $this->user->name,
            'liked' => !!$this->likes->where('user_id', auth()->id())->count(),
            'like_count' => $this->likes->count(),
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
