<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            Log::info("GET MY PLAYERS");
            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $players = Player::where('user_id', $request->user_id)->get();

            return response()->json(
                [
                "success" => true,
                "message" => 'Get my players',
                "data" => $players,
                ],200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET MY PLAYER ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get my players error"
                ],
                500
            );
        }
    }
    
    public function getMyPlayersById (Request $request)
    {
        try {
            //code...
            Log::info("GET MY PLAYERS");
            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $players = Player::where('user_id', Auth::user()->id)->where('id', $request->id)->get();

                if(count($players) === 0){

                    return response()->json(
                        [
                            "success" => false,
                            "message" => "Not players found"
                        ],
                        404
                    );

                }

            return response()->json(
                [
                "success" => true,
                "message" => 'Get my players',
                "data" => $players,
                ],200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET MY PLAYER ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get my players error"
                ],
                500
            );
        }
    }

    public function createNewPlayer (Request $request)
    {
        try {
            //code...
            Log::info("PLAYER CREATED");

            $validator = Validator::make($request->all(), [
                'user_id' => 'required | regex:/[0-9]/',
                'name' => 'required | regex:/[A-Za-z]+$/',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $newPlayer = new Player();

            $newPlayer->user_id = $request->input('user_id');
            $newPlayer->name = $request->input('name');

            $newPlayer->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Player created",
                    "data" => $newPlayer
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("CREATING PLAYER ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Creating player error"
                ],
                500
            );
        }
    }

    public function modifyPlayer (Request $request)
    {
        try {
            //code...
            Log::info("PLAYER NAME MODIFIED");

            $validator = Validator::make($request->all(), [
                'id' => 'required | regex:/[0-9]/',
                'user_id' => 'required | regex:/[0-9]/',
                'name' => 'required | regex:/[A-Za-z0-9]+$/',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            };

            $modPlayer = Player::find($request->id);

            if(!$modPlayer){
                return response()->json(
                    [
                        "success" => false,
                        "message" => 'Player do not exist'
                    ]
                );
            }

            $modPlayer->user_id = $request->input('user_id');
            $modPlayer->name = $request->input('name');

            $modPlayer->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Player name modified",
                    "data" => $modPlayer
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("MODIFY PLAYER ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Modify player error"
                ],
                500
            );
        }
    }

    public function deletePlayer (Request $request)
    {
        try {
            //code...
            Log::info("TEAM DELETED");

            $deletePLayer = Player::find($request->id);

            if(!$deletePLayer){
                return response()->json(
                    [
                        "success" => false,
                        "message" => 'Player do not exist'
                    ]
                );
            };

            Player::destroy($request->id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Player deleted",
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("DELETE PLAYER ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Delete player error"
                ],
                500
            );
        }
    }
}
