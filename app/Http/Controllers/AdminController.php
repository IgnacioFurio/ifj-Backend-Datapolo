<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AdminController extends Controller
{
    public function getAllUsers (Request $request)
    {
        try {
            //code...
            Log::info("GET USERS");

            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            // $users = Season::all();
            $users = DB::table('users')
                            ->orderBy('created_at', 'desc')
                            ->get();

            return [
                "success" => true,
                "message" => "Get all users",
                "data" => $users
            ];

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET USERS ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get users error"
                ],
                500
            );
        }
    }

    public function modifyUser (Request $request)
    {
        try {
            //code...
            Log::info("USER NAME MODIFIED");

            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $validator = Validator::make($request->all(), [
                'username' => 'string',
                'email' => 'string',
                'role_id' => 'regex:/[0-9]/',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            };

            $modUser = User::find($request->id);

            if(!$modUser){
                return response()->json(
                    [
                        "success" => false,
                        "message" => 'User do not exist'
                    ]
                );
            }

            $modUser->id = $request->input('id');
            $modUser->username = $request->input('username');
            $modUser->email = $request->input('email');
            $modUser->role_id = $request->input('role_id');

            $modUser->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "User modified",
                    "data" => $modUser
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("MODIFY USER ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Modify user error"
                ],
                500
            );
        }
    }

    public function deleteUser (Request $request)
    {
        try {
            //code...
            Log::info("USER DELETED");

            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $deleteUser = User::find($request->id);

            if(!$deleteUser){
                return response()->json(
                    [
                        "success" => false,
                        "message" => 'user do not exist'
                    ]
                );
            };

            
            User::destroy($request->id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "User deleted",
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("DELETE USER ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "User season error"
                ],
                500
            );
        }
    }
}
