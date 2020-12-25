<?php

namespace App\Http\Resources\Ticket;

use App\Http\Resources\DefaultResource;
use App\Http\Resources\Files\FileResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ticket_number' => $this->ticket_number,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'subject' => $this->subject,
            'body' => $this->body,
            'status' => $this->status,
            'file_url' => FileResource::collection($this->whenLoaded('file')),
            'priority' => optional( $this->priority)->title,
            'category' => optional($this->ticketCategory)->title,
            'replies' => TicketReplyResource::collection($this->whenLoaded('ticketReplies')),
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => formatDateForView($this->created_at),
        ];
    }
}
