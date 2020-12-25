<?php

namespace App\Http\Resources\Priority;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PriorityResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'priorities' => $this->collection
        ];
    }
}
