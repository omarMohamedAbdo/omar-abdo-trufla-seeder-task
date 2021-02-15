<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Movie extends JsonResource
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
            "id"                =>$this->id,
            "title"             =>$this->title,
            "popularity"        =>$this->popularity,
            "vote_average"      =>$this->vote_average,
            "created_at"        =>$this->created_at->diffForHumans(),
            "updated_at"        =>$this->updated_at->diffForHumans(),
            "genres"            =>Genre::collection($this->genres)
        ];
    }
}
