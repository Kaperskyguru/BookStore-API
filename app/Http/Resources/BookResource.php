<?php

namespace Tutornia\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' => (string) $this->title,
            'ISBN' => (string) $this->ISBN,
            'description' => (string) $this->description,
            'avg_review' => (string) $this->avg_review,
            'added_at' => (string) $this->created_at,
            'Reviews' => Review::collection($this->review),
        ];

    }
}