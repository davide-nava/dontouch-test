<?php

namespace App\Http\Controllers;

use App\Events\AccessOperationEvent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Validator;

/**
 * @OA\Info(title="Test API", version="0.1")
 */
class AuthController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @OA\Get(
     *     path="/api/auth/login",
     *     summary="Login user",
     *     @OA\Response(response="200", description="Ok"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response="500", description="Error message")
     * )
     */

    public function login(Request $request)
    {
        try {
            Event::dispatch(new AccessOperationEvent('AuthController@login'));
            Log::debug('Login user {user} {password}', ['user' => $request->email, 'password' => $request->password]);

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            // if (filter_input($request['email'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING, FILTER_SANITIZE_EMAIL) != '' && filter_input($request['password'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_STRING) != '') {
            //     return response()->json(['message' => 'Bad request', 'data' => $request], 400);
            // } else {
            return response()->json(['message' => 'OK', 'data' => $this->respondWithToken($request->all())]);
            // }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user(),
            'expires_in' => 60 * 24
        ]);
    }
}
