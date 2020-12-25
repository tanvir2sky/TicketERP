<?php


namespace App\Http\Controllers\Frontend\Ticket;


use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
use App\Service\FileUploadService;

class TicketCreateController extends ApiController
{
    public function store(TicketRequest $request)

    {
        // dd($request->all());
        $ticket = Ticket::create($request->all());
        $ticket = Ticket::findOrFail($ticket->id);
        if ($request->has('file')) {
            foreach ($request->file('file') as $file){
                FileUploadService::uploadNewFile($ticket, $file);

            }
        }
        return $this->respondWithSuccess(new TicketResource($ticket), "Successfully created new ticket.");
    }
}
