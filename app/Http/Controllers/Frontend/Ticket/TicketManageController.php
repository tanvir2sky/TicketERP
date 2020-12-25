<?php


namespace App\Http\Controllers\Frontend\Ticket;


use App\Http\Controllers\ApiController;
use App\Http\Requests\TicketReplyRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
use App\Service\FileUploadService;
use Illuminate\Http\Request;

class TicketManageController extends ApiController
{
    public function store(TicketReplyRequest $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        $reply = $ticket->ticketReplies()->create([
            'body' => $request->body
        ]);

        if ($request->has('file')) {
            FileUploadService::uploadNewFile($reply, $request->file('file'));
        }

        return $this->respondWithSuccess(new TicketResource($ticket), "Successfully created new ticket reply.");
    }

    public function searchTicket(Request $request)
    {
        $this->validate($request, [
            'ticket_number' => 'required|exists:tickets,ticket_number',
            'email' => 'required|email'
        ]);

        $ticket = Ticket::where('ticket_number', $request->ticket_number)
            ->where('email', $request->email)
            ->with(['file' , 'ticketReplies'])
            ->firstOrFail();
        return $this->respondWithSuccess(new TicketResource($ticket), "Successfully fetched ticket.");
    }
}
