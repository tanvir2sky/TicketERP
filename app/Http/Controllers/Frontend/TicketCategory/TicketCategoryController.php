<?php


namespace App\Http\Controllers\Frontend\TicketCategory;


use App\Http\Controllers\ApiController;
use App\Http\Resources\TicketCategory\TicketCategoryCollection;
use App\Http\Resources\TicketCategory\TicketCategoryResource;
use App\Models\TicketCategory;

class TicketCategoryController extends ApiController
{
    public function index()
    {
        $ticket_categories = new TicketCategoryCollection(TicketCategoryResource::collection(TicketCategory::all()));
        return $this->respondWithSuccess($ticket_categories, "Ticket Categories");
    }
}
