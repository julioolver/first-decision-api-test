<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function store(CreateUserRequest $request)
    {
        try {
            $userRequest = $request->all();
            $userRequest['password'] = bcrypt($request['password']);

            $user = User::create($userRequest);

            return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
