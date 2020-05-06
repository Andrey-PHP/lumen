<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'created_at' => $this->created_at,
            'update_at'  => $this->updated_at,
            'authors'    => AuthorResource::collection($this->authors),
        ];
    }
}
