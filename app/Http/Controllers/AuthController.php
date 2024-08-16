<?php

namespace App\Http\Controllers;

use App\Events\AccessOperationEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(title="Test API", version="0.1")
 */
class AuthController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login user",
     *     @OA\Response(response="200", description="Ok"),
     *     @OA\Response(response="400", description="Bad request"),
     *     @OA\Response(response="401", description="Unauthorized"),
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

            $validator->safe()->all();

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'data' => $request], 400);
            } else {
                $credentials = $request->only(['email', 'password']);

                if (!$token = Auth::setTTL(7200)->attempt($credentials)) {
                    return response()->json(['message' => __('messages.unauthorized')], 401);
                }

                return response()->json([
                    'message' => __('messages.ok'),
                    'data' => [
                        'userid' => Auth::user()->id,
                        'username' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'bearer_token' => $token,
                        'expires_in' => Auth::factory()->getTTL()
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Logout user",
     *     @OA\Response(response="200", description="Ok"),
     *     @OA\Response(response="500", description="Error message")
     * )
     */
    public function logout()
    {
        try {
            $token = auth()->tokenById(Auth::user()->userid);

            auth()->logout();

            return response()->json(['message' => __('messages.ok'), 'data' => null]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => null], 500);
        }
    }
}
