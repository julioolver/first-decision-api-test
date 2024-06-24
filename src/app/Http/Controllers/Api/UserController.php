<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
    }

    public function index()
    {
        try {
            $users = $this->service->getAll();

            return UserResource::collection($users);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
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

    public function update(int $id, UpdateUserRequest $request)
    {
        try {
            $userRequest = $request->all();
            $this->service->update($id, $userRequest);

            return response()->json(['message' => 'User updated successfully'], Response::HTTP_OK);
        } catch (UserNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        } 
    }

    public function destroy(int $id)
    {
        try {
            $this->service->delete($id);

            return response()->json(['message' => 'User deleted successfully'], Response::HTTP_NO_CONTENT);
        } catch (UserNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
