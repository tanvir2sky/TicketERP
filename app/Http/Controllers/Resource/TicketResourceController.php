<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\ApiController;
use App\Http\Requests\TicketUpdateRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Http\Resources\Ticket\TicketResourceCollection;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TicketResourceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tickets = Ticket::query();
        if (\request()->has('status')) {
            $tickets = $tickets->where('status', \request()->get('status'));
        }
        if(auth()->user()->isAgent()){//For Agent Only Return Related Tickets
            $tickets = $tickets->where('user_id' , auth()->id());
        }
        $tickets = $tickets->with(['ticketReplies' , 'user' , 'file'])->get();
        return $this->respondWithSuccess(new TicketResourceCollection(TicketResource::collection($tickets)), "All Tickets");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function show($id)
    {
        $ticket = Ticket::with(['ticketReplies' , 'user' , 'file'])->findOrFail($id);
        return $this->respondWithSuccess(new TicketResource($ticket), "Single Ticket");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TicketUpdateRequest $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        Gate::authorize('update-ticket' , $ticket);

        $ticket->update($request->all());
        return $this->respondWithSuccess(new TicketResource($ticket), "Successfully Updated Ticket");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
