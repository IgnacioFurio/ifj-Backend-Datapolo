<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function newUser(Request $request)
    {
        try {
            //code...
            Log::info("CREATED USER");

            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|min:6|max:12',
            ]);

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password'])
            ]);

            $token = $user->createToken('apiToken')->plainTextToken;

            $res = [
                "data" => $user,
                "token" => $token
            ];

            return response()->json(
                [
                    "success" => true,
                    "message" => "User created successfully",
                    "data" => $res
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("CREATED USER ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Create User error"
                ],
                500
            );
        }
    }

    public function login(Request $request)
    {
        try {
            //code...
            Log::info("LOG IN");

            $request->validate([
                'email' => 'required|string',   
                'password' => 'required|string',
            ]);
    
            $user = User::query()->where('email', $request['email'])->first();
            
                if (!$user) {
                return response(
                    [
                        "success" => false, 
                        "message" => "Invalid email or password",
                    ], 
                    Response::HTTP_NOT_FOUND
                );
                }

                // password validation
                if (!Hash::check($request['password'], $user->password)) {
                    return response([
                        "success" => true, 
                        "message" => "Invalid email or password"
                    ], 
                    Response::HTTP_NOT_FOUND
                );
                }
    
            $token = $user->createToken('apiToken')->plainTextToken;
    
            return response()->json(
                [
                    "success" => true, 
                    "message" => "User logged successfully", 
                    "token" => $token
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("LOGIN ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Log In error"
                ],
                500
            );
        }
    }

    public function logout(Request $request)
    {
        try {
            //code...
            Log::info("LOG OUT");
            $accessToken = $request->bearerToken();

            // Get access token from database
            $token = PersonalAccessToken::findToken($accessToken);

            // Revoke token
            $token->delete();
            
            return response()->json(
                [
                    "success" => true,
                    "message" => "Logout successfully"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            //throw $th;
            Log::info("LOGOUT ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Log Out error"
                ],
                500
            );
        }
    }
}