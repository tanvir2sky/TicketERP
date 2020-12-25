<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\TicketCategoryResource;
use Illuminate\Http\Request;

class UserProfileController extends ApiController
{
    public function updateProfile(Request $request)
    {
        /**
         * Update the user's first_name and last_name.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\JsonResponse
         * @throws \Illuminate\Validation\ValidationException
         */
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'max:255',
        ]);

        $request->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        return $this->respondWithSuccess(new TicketCategoryResource($request->user()),"Successfully Updated User Profile");
    }

    /**
     * Update the user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);
        return $this->respondWithSuccess(new TicketCategoryResource($request->user()),"Successfully Updated User Password");
    }
}
