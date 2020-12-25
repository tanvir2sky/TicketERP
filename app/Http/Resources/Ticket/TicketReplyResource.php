<?php

namespace App\Http\Resources\Ticket;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketReplyResource extends JsonResource
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
            'body' => $this->body,
            'created_at' => formatDateForView($this->created_at),
            'created_by' => ($this->creator)? $this->creator->first_name : $this->ticket->name,
            'is_customer' => $this->created_by ? false : true,
        ];
    }
}
