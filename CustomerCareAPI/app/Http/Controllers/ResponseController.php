<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(
 *     name="Responses",
 *     description="Endpoints for managing ticket responses"
 * )
 */
class ResponseController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/responses",
     *     summary="Get all responses",
     *     description="Returns a list of all responses.",
     *     tags={"Responses"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(response=200, description="List of responses"),
     *     @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function index()
    {
        return response()->json(Response::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/responses",
     *     summary="Create a new response",
     *     description="Add a new response to a ticket.",
     *     tags={"Responses"},
     *     security={{ "sanctum": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"message", "ticket_id"},
     *             @OA\Property(property="message", type="string", example="Your ticket is being processed."),
     *             @OA\Property(property="ticket_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Response created"),
     *     @OA\Response(response=400, description="Invalid input"),
     *     @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        $response = Response::create([
            'message' => $request->message,
            'ticket_id' => $request->ticket_id,
            'user_id' => Auth::id(),
        ]);

        return response()->json($response, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/responses/{id}",
     *     summary="Get a single response",
     *     description="Retrieve a specific response by ID.",
     *     tags={"Responses"},
     *     security={{ "sanctum": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Response details"),
     *     @OA\Response(response=404, description="Response not found"),
     * )
     */
    public function show(Response $response)
    {
        return response()->json($response, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/responses/{id}",
     *     summary="Update a response",
     *     description="Modify an existing response.",
     *     tags={"Responses"},
     *     security={{ "sanctum": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"message"},
     *             @OA\Property(property="message", type="string", example="Your ticket has been updated.")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Response updated"),
     *     @OA\Response(response=403, description="Unauthorized to update this response"),
     *     @OA\Response(response=404, description="Response not found"),
     * )
     */
    public function update(Request $request, Response $response)
    {
        if ($response->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $response->update([
            'message' => $request->message,
        ]);

        return response()->json($response, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/responses/{id}",
     *     summary="Delete a response",
     *     description="Remove an existing response from the system.",
     *     tags={"Responses"},
     *     security={{ "sanctum": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Response deleted"),
     *     @OA\Response(response=403, description="Unauthorized to delete this response"),
     *     @OA\Response(response=404, description="Response not found"),
     * )
     */
    public function destroy(Response $response)
    {
        if ($response->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $response->delete();
        return response()->json(null, 204);
    }
}
