<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Thread extends JsonResource
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
            'qr' => $this->slug,
            'title' => $this->title,
            'whatsapp' => $this->whatsapp,
            'indoor' => $this->indoor,
        ];
    }
}
