<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

class TokenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $user = User::findOrFail(1);
            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'data' => [
                    'message' => 'Token created successfully',
                    'status' => 'success',
                    'data' => [
                        'token' => $token
                    ]
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'data' => [
                    'message' => 'Token creation failed',
                    'status' => 'failed',
                    'data' => []
                ]
            ], 500);
        }
    }
}
