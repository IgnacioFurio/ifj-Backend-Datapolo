<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

            $teams = Team::where('user_id', $request->user_id)->get();

            return [
                "success" => true,
                "data" => $teams
            ];

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

    public function createNewTeam (Request $request)
    {
        try {
            //code...
            Log::info("TEAM CREATED");

            $validator = Validator::make($request->all(), [
                'user_id' => 'required | regex:/[0-9]/',
                'team_name' => 'required | regex:/[A-Za-z0-9]+$/',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $newTeam = new Team();

            $newTeam->user_id = $request->input('user_id');
            $newTeam->team_name = $request->input('team_name');

            $newTeam->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Team created",
                    "data" => $newTeam
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("CREATING TEAM ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Creating team error"
                ],
                500
            );
        }
    }

    public function modifyTeam (Request $request)
    {
        try {
            //code...
            Log::info("TEAM MODIFIED");

            $validator = Validator::make($request->all(), [
                'id' => 'required | regex:/[0-9]/',
                'user_id' => 'required | regex:/[0-9]/',
                'team_name' => 'required | regex:/[A-Za-z0-9]+$/',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            };

            $modTeam = Team::find($request->id);

            if(!$modTeam){
                return response()->json(
                    [
                        "success" => false,
                        "message" => 'Pizza do not exist'
                    ]
                );
            }

            $modTeam->user_id = $request->input('user_id');
            $modTeam->team_name = $request->input('team_name');

            $modTeam->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Team modified",
                    "data" => $modTeam
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("MODIFY TEAM ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Modify team error"
                ],
                500
            );
        }
        }
}
