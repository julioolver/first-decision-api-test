<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="API Documentation test - First Decision", version="1.0")
 */
class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Lista os usuários do sistema",
     *     tags={"users"},
     *     @OA\Response(
     *         response=200,
     *         description="Retorna uma lista de usuários do sistema",
     *         @OA\JsonContent(ref="#/components/schemas/userArray"),
     *     )
     * )
     */
    public function index()
    {
        try {
            $users = $this->service->getAll();

            return UserResource::collection($users);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Cria um usuário no sistema",
     *     description="Cria um usuário na base de dados do sistema",
     *     tags={"users"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do novo item",
     *         @OA\JsonContent(
     *             required={"name","email","password","password_confirmation"},
     *             @OA\Property(property="name", type="string", example="Nome do usuário"),
     *             @OA\Property(property="email", type="string", example="teste@teste1.com"),
     *             @OA\Property(property="password", type="string", example="123456"),
     *             @OA\Property(property="password_confirmation", type="string", example="123456"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Retorna o user criado",
     *         @OA\JsonContent(ref="#/components/schemas/userObject"),
     *     )
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Edita um usuário no sistema",
     *     description="Edita um usuário na base de dados do sistema",
     *     tags={"users"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Filtrar um usuário por ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do novo item",
     *         @OA\JsonContent(
     *             required={"name","email","password","password_confirmation"},
     *             @OA\Property(property="name", type="string", example="Nome do usuário Editado"),
     *             @OA\Property(property="email", type="string", example="teste_editado@teste.com"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retorna o user criado",
     *         @OA\JsonContent(ref="#/components/schemas/userObject"),
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Excluir um usuário do sistema",
     *     tags={"users"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Excluir um usuário por ID",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="retorna uma mensagem de que o item foi deletado com sucesso",
     *     )
     * )
     */
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
