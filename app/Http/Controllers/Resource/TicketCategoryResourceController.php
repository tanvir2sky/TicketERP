<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\ApiController;
use App\Http\Requests\TicketCategoryRequest;
use App\Http\Resources\TicketCategory\TicketCategoryCollection;
use App\Http\Resources\TicketCategory\TicketCategoryResource;
use App\Models\TicketCategory;
use App\Service\FileUploadService;
use App\User;

class TicketCategoryResourceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $ticket_categories = new TicketCategoryCollection(TicketCategoryResource::collection(TicketCategory::all()));

        return $this->respondWithSuccess($ticket_categories, "All Ticket Category");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TicketCategoryRequest $request)
    {
        $ticket_category = TicketCategory::create($request->all());

        return $this->respondWithSuccess(new TicketCategoryResource($ticket_category), "Successfully Updated Ticket Category");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)

    {
        return $this->respondWithSuccess(new TicketCategoryResource(TicketCategory::findOrFail($id)), "Single Ticket Category");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TicketCategoryRequest $request, $id)
    {
        $ticket_category = TicketCategory::findOrFail($id);
        $ticket_category->update($request->all());
        return $this->respondWithSuccess(new TicketCategoryResource($ticket_category), "Successfully Updated Ticket Category");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ticket_category = TicketCategory::findOrFail($id);
        $ticket_category->delete();
        return $this->respondWithSuccess(new TicketCategoryResource($ticket_category), "Successfully Deleted Ticket Category");
    }
}
