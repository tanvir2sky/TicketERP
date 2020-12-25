<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,/**/
            'email' => $this->email,
            'role' => $this->role,
            'photo_url' => $this->photo_url,
            'created_at' => formatDateForView($this->created_at),
        ];
    }
}
