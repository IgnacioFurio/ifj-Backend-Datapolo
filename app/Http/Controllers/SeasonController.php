<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SeasonController extends Controller
{
    public function getAllSeasons ()
    {
        try {
            //code...
            Log::info("GET SEASONS");

            $seasons = Season::all();

            return [
                "success" => true,
                "message" => "Get all seasons",
                "data" => $seasons
            ];

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("GET SEASONS ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Get seasons error"
                ],
                500
            );
        }
    }

    public function createNewSeason (Request $request)
    {
        try {
            //code...
            Log::info("SEASON CREATED");

            // ToDo validation for years 
            $validator = Validator::make($request->all(), [
                'season' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $newSeason = new Season();

            $newSeason->season = $request->input('season');

            $newSeason->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "season created",
                    "data" => $newSeason
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("CREATING SEASON ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Creating season error"
                ],
                500
            );
        }
    }

    public function modifySeason (Request $request)
    {
        try {
            //code...
            Log::info("SASON NAME MODIFIED");

            $validator = Validator::make($request->all(), [
                'id' => 'required | regex:/[0-9]/',
                'season' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            };

            $modSeason = Season::find($request->id);

            if(!$modSeason){
                return response()->json(
                    [
                        "success" => false,
                        "message" => 'Season do not exist'
                    ]
                );
            }

            $modSeason->id = $request->input('id');
            $modSeason->season = $request->input('season');

            $modSeason->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Season modified",
                    "data" => $modSeason
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("MODIFY SEASON ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Modify season error"
                ],
                500
            );
        }
    }

    public function deleteSeason (Request $request)
    {
        try {
            //code...
            Log::info("SEASON DELETED");

            $deleteSeason = Season::find($request->id);

            if(!$deleteSeason){
                return response()->json(
                    [
                        "success" => false,
                        "message" => 'Season do not exist'
                    ]
                );
            };

            Season::destroy($request->id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Season deleted",
                ],
                200
            );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("DELETE SEASON ERROR ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Delete season error"
                ],
                500
            );
        }
    }
}
