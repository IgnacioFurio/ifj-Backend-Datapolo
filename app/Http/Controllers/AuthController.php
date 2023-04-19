<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function newUser(Request $request)
    {
        try {
            //code...
            //ToDo Log
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
            Log::info("CREATED USER ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering new user"
                ],
                500
            );
        }
    }
}
