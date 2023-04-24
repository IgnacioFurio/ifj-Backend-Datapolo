<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getUserData(Request $request)
    {
        try {
            // //code...
            // Log::info("USER DATA CALL");

            $user = DB::table('users')->where('email', '=', $request->email)->get();

            return [
                "succes" => true,
                "data" => $user
            ];

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("USER DATA CALL ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Find User Information error"
                ],
                500
            );
        }
    }
}
