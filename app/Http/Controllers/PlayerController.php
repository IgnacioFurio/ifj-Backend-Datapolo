<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
}
