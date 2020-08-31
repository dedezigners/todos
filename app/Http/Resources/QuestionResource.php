<?php

namespace App\Http\Resources;

use App\Http\Resources\ReplyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'desc' => $this->description,
            'category' => $this->category->name,
            'created_by' => $this->user->name,
            'created_at' => $this->created_at->diffForHumans(),
            'user_id' => $this->user_id,
            'replies' => ReplyResource::collection($this->replies),
            'reply_count' => $this->replies->count(),
        ];
    }
}
