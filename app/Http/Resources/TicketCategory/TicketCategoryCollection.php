<?php

namespace App\Http\Resources\TicketCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketCategoryCollection extends ResourceCollection
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
            'ticket_categories' => $this->collection
        ];
    }
}
