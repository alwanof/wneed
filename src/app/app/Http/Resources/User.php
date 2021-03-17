<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //if ($this->level == 2) {
        return [
            'id' => $this->id,
            'logo' => $this->avatar,
            'slug' => $this->slug,
            'name' => $this->name,
            'email' => $this->email,
            'expDate' => $this->expiration_date,
            'userConfig' => $this->settings

        ];
        //}
        //return [];
    }
}
