<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\ApiController;
use App\Http\Requests\FaqRequest;
use App\Http\Resources\Faq\FaqResource;
use App\Http\Resources\Faq\FaqResourceCollection;
use App\Models\Faq;

class FaqResourceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $faqs = new FaqResourceCollection(FaqResource::collection(Faq::all()));

        return $this->respondWithSuccess($faqs, "All Faqs");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FaqRequest $request)
    {
        $faq = Faq::create($request->all());

        return $this->respondWithSuccess(new FaqResource($faq), "Successfully Created Faq");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->respondWithSuccess(new FaqResource(Faq::findOrFail($id)), "Single Faq");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FaqRequest $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($request->all());
        return $this->respondWithSuccess(new FaqResource($faq), "Successfully Updated Faq");
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
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return $this->respondWithSuccess(new FaqResource($faq), "Successfully Deleted Faq");
    }
}
