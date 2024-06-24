<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $userRequest = $request->all();
            $user = $this->service->create($userRequest);

            return (new UserResource($user))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        } catch (\Error $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(int $id, CreateUserRequest $request)
    {
        try {
            $userRequest = $request->all();
            $this->service->update($id, $userRequest);

            return response()->json(['message' => 'User updated successfully'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        } catch (\Error $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
