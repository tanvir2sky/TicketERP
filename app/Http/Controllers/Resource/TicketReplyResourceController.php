<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\ApiController;
use App\Http\Requests\TicketReplyRequest;
use App\Http\Resources\Ticket\TicketReplyResource;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
use App\Notifications\TicketReplyNotification;
use App\Service\FileUploadService;
use Illuminate\Http\Request;

class TicketReplyResourceController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TicketReplyRequest $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        $reply = $ticket->ticketReplies()->create([
            'body' => $request->body,
        ]);

//        $ticket->notify(new TicketReplyNotification());

        return $this->respondWithSuccess(TicketReplyResource::collection($ticket->ticketReplies), "Successfully created new ticket reply.");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
