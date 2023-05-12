<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Goal;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class StadisticsController extends Controller
{
    public function getAllMyGoalStadistics (Request $request)
    {
        try {
            //code...
            Log::info("GET MY GOALS BY TEAM ID");

            $accessToken = $request->bearerToken();
            $token = PersonalAccessToken::findToken($accessToken);

            $validator = Validator::make($request->all(), [
                'team_id' =>'required | regex:/[0-9]/',
                'rival_id' => 'regex:/[0-9]/',
                'season_id' => 'regex:/[0-9]/',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            
            $teamId = $request->integer('team_id');            
            $rivalId = $request->integer('rival_id');
            $seasonId = $request->integer('season_id');

            $locale = $request->string('locale');
            $localeCheck = true;

            if ($locale == "locale") {
                $localeCheck = true;
            } else if ($locale == "visitor") {
                $localeCheck = false;
            } else if ($locale == "") {
                $locale = null;
            }

            $game = DB::table('games')
                ->where('my_team_id', $teamId)
                ->when($rivalId, function ($game) use ($rivalId) {
                    $game->where('my_rival_id', $rivalId);
                })
                ->when($seasonId, function ($game) use ($seasonId) {
                    $game->where('season_id', $seasonId);
                })
                ->when($locale, function ( $game) use ($localeCheck) {
                    $game->where('locale', $localeCheck);
                })                
                ->get();

            if(count($game) === 0){
                return response()->json(
                    [
                    "success" => true,
                    "message" => 'Not goals with this requirements found.',
                    ],200
                );
            }

            for($i = 0 ; $i < count($game) ; $i++){

                $goals[] = Goal::where('game_id', $game[$i]->id)
                                ->where('team_id', $teamId)
                                ->get();

            };

            if(count($goals[0]) === 0){
                return response()->json(
                    [
                    "success" => true,
                    "message" => 'Not goals with this requirements found.',
                    ],200
                );
            }
            

            return response()->json(
                [
                "success" => true,
                "message" => 'Here are your game stadistics.',
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
    
}
