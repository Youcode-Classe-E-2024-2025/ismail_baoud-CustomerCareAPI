<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(array $credentials)
    {

        $user = User::where('email', $credentials['email'])->first();

        // Vérification des identifiants
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }
    
        // Création du token d'authentification avec Sanctum
        $token = $user->createToken('API Token')->plainTextToken;
    
        // Retourner la réponse avec le token et les données utilisateur
        return response()->json([
            'message' => 'Connexion réussie',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout($user)
    {
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $user->tokens()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
