<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Goal;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class GoalController extends Controller
{
    public function getAllGoals (Request $request)
    {
        try {
            //code...
            Log::info("GET ALL GOAL");

            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $goals = Goal::all();

            return [
                "success" => true,
                "message" => "Get all goals",
                "data" => $goals
            ];

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET GOALS ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get goals error"
                ],
                500
            );
        }
    }

    public function getAllMyGoals (Request $request)
    {
        try {
            //code...
            Log::info("GET MY GOALS");

            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $teams = Team::where('user_id', Auth::user()->id)->get();

            
            for ($i = 0 ; $i < count($teams)  ; $i++) { 
                
                $array[] = Goal::where('team_id', $teams[$i]->id)->orderBy('game_id', 'asc')->get();

                if( count($array[$i]) === 0 ){

                    unset($array[$i]);

                };

            }

            if(count($array) === 0){

                return response()->json(
                    [
                    "success" => false,
                    "message" => 'Not goals found',
                    ],404
                );

            }

            return response()->json(
                [
                "success" => true,
                "message" => 'Get my goals',
                "data" => $array
                ],200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET MY GOALS ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get my goals error"
                ],
                500
            );
        }
    }

    public function getAllMyGoalsByTeamId (Request $request)
    {
        try {
            //code...
            Log::info("GET MY GOALS BY TEAM ID");

            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $teams = Team::where('user_id', Auth::user()->id)->get();

            
            for ($i = 0 ; $i < count($teams)  ; $i++) { 
                                
                if($teams[$i]->id === $request->team_id){

                    $goals = Goal::where('team_id', $request->team_id)->get();

                    if(count($goals) === 0){

                        return response()->json(
                            [
                            "success" => false,
                            "message" => 'Not goals asociated with this team yet',
                            ],200
                        );
                    }
                }
            }

            return response()->json(
                [
                "success" => true,
                "message" => 'Get my goals by team id',
                "data" => $goals
                ],200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET MY GOALS BY TEAM ID ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get my goals by team id error"
                ],
                500
            );
        }
    }

    public function getAllMyGoalsByTeamIdAndGameId (Request $request)
    {
        try {
            //code...
            Log::info("GET MY GOALS BY TEAM ID");

            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $teams = Team::where('user_id', Auth::user()->id)->get();

            
            for ($i = 0 ; $i < count($teams)  ; $i++) { 
                                
                if($teams[$i]->id === $request->team_id){

                    $goals = Goal::where('team_id', $request->team_id)->where('game_id', $request->game_id)->get();
                }
            }

            return response()->json(
                [
                "success" => true,
                "message" => 'Get my goals by team id',
                "data" => $goals
                ],200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET MY GOALS BY TEAM ID ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get my goals by team id error"
                ],
                500
            );
        }
    }

    public function createNewGoal (Request $request)
    {
        try {
            //code...
            Log::info("GOAL CREATE");

            $validator = Validator::make($request->all(), [
                'team_id' => 'required | regex:/[0-9]/',
                'game_id' => 'required | regex:/[0-9]/',
                'player_id' => 'required | regex:/[0-9]/',
                'zone' => 'required | regex:/[0-9]/',
                'player_nº' => 'required | regex:/[0-9]/'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $newGoal = new Goal();

            $newGoal->team_id = $request->input('team_id');
            $newGoal->game_id = $request->input('game_id');
            $newGoal->player_id = $request->input('player_id');
            $newGoal->zone = $request->input('zone');
            $newGoal->player_nº = $request->input('player_nº');

            $newGoal->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Goal created",
                    "data" => $newGoal
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("CREATING GOAL ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Creating goal error"
                ],
                500
            );
        }
    }

    public function modifyGoal (Request $request)
    {
        try {
            //code...
            Log::info("GOAL MODIFIED");

            $validator = Validator::make($request->all(), [
                'id' => 'required | regex:/[0-9]/',
                'team_id' => 'required | regex:/[0-9]/',
                'game_id' => 'required | regex:/[0-9]/',
                'player_id' => 'required | regex:/[0-9]/',
                'zone' => 'required | regex:/[0-9]/',
                'player_nº' => 'required | regex:/[0-9]/'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            };

            $teams = Team::where('user_id', Auth::user()->id)->get();

            $modGoal = Goal::find($request->id);

            $check = false;

            $modGoal->id = $request->input('id');
            $modGoal->team_id = $request->input('team_id');
            $modGoal->game_id = $request->input('game_id');
            $modGoal->player_id = $request->input('player_id');
            $modGoal->zone = $request->input('zone');
            $modGoal->player_nº = $request->input('player_nº');

            for ($i=0 ; $i < count($teams) ; $i++) { 
                
                if( $modGoal->team_id === $teams[$i]->id ){

                    $check = true;

                    $i = count($teams);
                }
            }    
            
            if($check === false){

                return response()->json(
                    [
                        "success" => false,
                        "message" => "Goal not found",
                    ],
                    404
                );

            }
            else if ($check === true){
    
                $modGoal->save();
            }


            return response()->json(
                [
                    "success" => true,
                    "message" => "Goal modified",
                    "data" => $modGoal
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("MODIFY GAME ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Modify goal error"
                ],
                500
            );
        }
    }
    
    public function deleteGoal (Request $request)
    {
        try {
            //code...
            Log::info("GOAL DESTROY");

            $validator = Validator::make($request->all(), [
                'id' => 'required | regex:/[0-9]/',
            ]);

            $teams = Team::where('user_id', Auth::user()->id)->get();

            $destroyGoal = Goal::find($request->id);

            $check = false;

            for ($i=0 ; $i < count($teams) ; $i++) { 
                            
                if( $destroyGoal->team_id === $teams[$i]->id  ){

                    $check = true;

                    $i = count($teams);
                }
            }    
            
            if($check === false){

                return response()->json(
                    [
                        "success" => false,
                        "message" => "Goal not found",
                    ],
                    404
                );
            } elseif ($check === true){    
                
                Goal::destroy($request->id);
            }


            return response()->json(
                [
                    "success" => true,
                    "message" => "Goal destroyed",
                    "data" => $destroyGoal
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("DESTROY GOAL ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Destroy goal error"
                ],
                500
            );
        }
    }
}
