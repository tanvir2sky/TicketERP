<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;
use App\Setting;
use Illuminate\Http\Request;

class GlobalSettingsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $settings = Setting::all();
        return $this->respondWithSuccess(DefaultResource::collection($settings) , "All Settings");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $items = json_decode( $request->settings , 0) ;
        if(is_array($items)){
            foreach ($items as $item){
                $setting = Setting::where('key' , $item->key)->update(['value' => $item->value]);
            }
        }

        return $this->respondWithSuccess([],'Successfully Updated Settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
