<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Service\FileUploadService;
use App\User;
use Illuminate\Http\Request;

class UserResourceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = new UserCollection(UserResource::collection(User::all()));

        return $this->respondWithSuccess($user, "All Users");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        if ($request->has('file')) {
            FileUploadService::uploadNewFile($user, $request->file('file'));
        }

        return $this->respondWithSuccess(new UserResource( $user), "Successfully Updated User");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->respondWithSuccess(new UserResource(User::findOrFail($id)), "Single User");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $this->respondWithSuccess(new UserResource($user), "Successfully Updated User");
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
        $user = User::findOrFail($id);
        if ($user->id == \Auth::id()) {
            return $this->respondWithNotFound($user, "User Cannot Delete Himself");
        }
        $user->delete();
        return $this->respondWithSuccess(new UserResource($user), "Successfully Deleted User");
    }
}
