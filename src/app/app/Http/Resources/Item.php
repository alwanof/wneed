<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Item extends JsonResource
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
            'photo' => $this->avatar,
            'gallery' => [],
            'mainTitle' => $this->title_a,
            'altTitle' => $this->title_b,
            'mainDescription' => $this->desc_a,
            'altDescription' => $this->desc_b,
            'price' => $this->price,
            'prevalence' => $this->prevalence,
            'available' => $this->available,
            'altTitle' => $this->title_b,
            'category' => new Category($this->category),
        ];
    }
}
