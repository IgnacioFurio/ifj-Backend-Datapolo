<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
}
