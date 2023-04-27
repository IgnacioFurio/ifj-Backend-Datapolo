<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

class PlayerController extends Controller
{
    public function getAllPlayers ()
    {
        try {
            //code...
            Log::info("GET TEAMS");

            $players = Player::all();

            return [
                "success" => true,
                "data" => $players
            ];

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET PLAYERS ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get players error"
                ],
                500
            );
        }
    }

    public function getAllMyPlayers (Request $request)
    {
        try {
            //code...
            Log::info("GET MY TEAMS");
            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $players = Player::where('user_id', $request->user_id)->get();

            return response()->json(
                [
                "success" => true,
                "message" => 'Get my teams',
                "data" => $players,
                ],200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET MY TEAMS ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get my teams error"
                ],
                500
            );
        }
    }
}
