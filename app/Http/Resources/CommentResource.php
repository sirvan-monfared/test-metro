<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'body' => $this->body,
            'user' => new PublicUserResource($this->whenLoaded('user')),
            'fname' => $this->fname,
            'children' => CommentResource::collection($this->whenLoaded('children')),
            'created_at' => $this->created_at->toJalali()->formatDifference(),
            'type' => $this->type,
            'rating' => $this->rating
        ];
    }
}
