<?php


namespace App\Http\Controllers\Frontend\Faq;


use App\Http\Controllers\ApiController;
use App\Http\Resources\Faq\FaqResource;
use App\Http\Resources\Faq\FaqResourceCollection;
use App\Http\Resources\Faq\FrontendFaqResource;
use App\Models\Faq;

class FaqController extends ApiController
{
    public function index()
    {
        $faqs = FrontendFaqResource::collection(Faq::latest()->get());

        return $this->respondWithSuccess($faqs, "All Faqs");
    }

    public function show($id)
    {
        return $this->respondWithSuccess(new FaqResource(Faq::findOrFail($id)), "Single Faq");
    }
}
