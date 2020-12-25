<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\ApiController;
use App\Http\Requests\PriorityRequest;
use App\Http\Resources\Priority\PriorityResourceCollection;
use App\Http\Resources\Priority\PriorityResource;
use App\Models\Priority;

class PriorityResourceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $priorities = new PriorityResourceCollection(PriorityResource::collection(Priority::all()));

        return $this->respondWithSuccess($priorities, "All Priority");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PriorityRequest $request)
    {
        $priority = Priority::create($request->all());

        return $this->respondWithSuccess(new PriorityResource($priority), "Successfully Created Priority");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->respondWithSuccess(new PriorityResource(Priority::findOrFail($id)), "Single Priority");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PriorityRequest $request, $id)
    {
        $priority = Priority::findOrFail($id);
        $priority->update($request->all());
        return $this->respondWithSuccess(new PriorityResource($priority), "Successfully Updated Priority");
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
        $priority = Priority::findOrFail($id);
        $priority->delete();
        return $this->respondWithSuccess(new PriorityResource($priority), "Successfully Deleted Priority");
    }
}
