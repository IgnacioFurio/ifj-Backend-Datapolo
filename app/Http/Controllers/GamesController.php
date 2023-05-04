<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class GamesController extends Controller
{
    public function getAllGames ()
    {
        try {
            //code...
            Log::info("GET GAMES");

            $games = Game::all();

            return [
                "success" => true,
                "message" => "Get all games",
                "data" => $games
            ];

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET GAMES ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get games error"
                ],
                500
            );
        }
    }

    public function getAllMyGames (Request $request)
    {
        try {
            //code...
            Log::info("GET MY GAMES");
            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $teams = Team::where('user_id', Auth::user()->id)->get();

            
            for ($i = 0 ; $i < count($teams)  ; $i++) { 
                
                $array[] = Game::where('my_team_id', $teams[$i]->id)->get();

                if( count($array[$i]) === 0 ){

                    unset($array[$i]);

                };


            }

            return response()->json(
                [
                "success" => true,
                "message" => 'Get my games',
                "data" => $array
                ],200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET MY GAMES ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get my games id error"
                ],
                500
            );
        }
    }

    public function getAllMyGamesByTeamId (Request $request)
    {
        try {
            //code...
            Log::info("GET MY GAMES BY TEAM ID");
            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $teams = Team::where('user_id', Auth::user()->id)->get();

            
            for ($i = 0 ; $i < count($teams)  ; $i++) { 
                
                $array[] = $teams[$i]->id;
                
                if($teams[$i]->id === $request->my_team_id){

                    $games = Game::where('my_team_id', $request->my_team_id)->orwhere('my_rival_id', '=', $request->my_team_id)->get();

                    if(count($games) === 0){

                        return response()->json(
                            [
                            "success" => false,
                            "message" => 'Not games asociated with this team yet',
                            ],200
                        );
                    }
                }
            }

            return response()->json(
                [
                "success" => true,
                "message" => 'Get my games by team id',
                "data" => $games
                ],200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET MY GAMES BY TEAM ID ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get my games by team id error"
                ],
                500
            );
        }
    }

    public function createNewGame (Request $request)
    {
        try {
            //code...
            Log::info("GAME CREATED");

            $validator = Validator::make($request->all(), [
                'season_id' => 'required | regex:/[0-9]/',
                'my_team_id' => 'required | regex:/[0-9]/',
                'my_rival_id' => 'required | regex:/[0-9]/',
                'locale' => 'required | boolean',
                'friendly' => 'required | boolean'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $newGame = new GAme();

            $newGame->season_id = $request->input('season_id');
            $newGame->my_team_id = $request->input('my_team_id');
            $newGame->my_rival_id = $request->input('my_rival_id');
            $newGame->locale = $request->input('locale');
            $newGame->friendly = $request->input('friendly');

            $newGame->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Game created",
                    "data" => $newGame
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("CREATING GAME ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Creating game error"
                ],
                500
            );
        }
    }
}
