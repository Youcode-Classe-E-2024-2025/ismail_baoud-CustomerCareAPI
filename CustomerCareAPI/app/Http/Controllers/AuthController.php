<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illiminate\Http\JsonResponse;


class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="secret123")
     *         ),
     *     ),
     *     @OA\Response(response=201, description="User registered successfully"),
     *     @OA\Response(response=400, description="Validation errors")
     * )
     */
    public function register(RegisterRequest $request)
    {

        $result = $this->authService->register($request->validated());

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $result['user'],
            'token' => $result['token'],
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="secret123")
     *         ),
     *     ),
     *     @OA\Response(response=200, description="Login successful"),
     *     @OA\Response(response=401, description="Invalid credentials")
     * )
     */

     public function login(Request $request)
     {
         $validateur = Validator::make($request->all(), [
             'email' => 'required|email',
             'password' => 'required',
         ]);
     
         if ($validateur->fails()) {
             return response()->json(['errors' => $validateur->errors()], 422);
         }
     
         return $this->authService->login($validateur->validated());
     }
/**
 * @OA\Post(
 *     path="/api/logout",
 *     summary="User logout",
 *     security={{ "bearerAuth": {} }},
 *     tags={"Authentication"},
 *     @OA\Response(response=200, description="Logout successful"),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 */
public function logout(Request $request)
{
    return $this->authService->logout($request->user());
}

}