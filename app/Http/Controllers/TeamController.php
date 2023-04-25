<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    public function getAllTeams ()
    {
        try {
            //code...
            Log::info("GET TEAMS");

            $teams = Team::all();

            return [
                "success" => true,
                "data" => $teams
            ];

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET TEAMS ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get teams error"
                ],
                500
            );
        }
    }
    public function getAllMyTeams (Request $request)
    {
        try {
            //code...
            Log::info("GET MY TEAMS");

            $teams = Team::all();

            return [
                "success" => true,
                "data" => $teams
            ];

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET TEAMS ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get teams error"
                ],
                500
            );
        }
    }
}
