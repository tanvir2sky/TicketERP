<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LogoRequest;
use Illuminate\Http\Request;

class LogoResourceController extends ApiController
{
    public function update(LogoRequest $request, $id)
    {
        $logo = $request->file('logo');
        $name = 'site_logo.'.$logo->getClientOriginalExtension();
        $request->file('logo')->storeAs('images' , $name ,['disk' => 'general']);
        return $this->respondWithSuccess([] , 'Successfully Updated Logo');
    }
}
