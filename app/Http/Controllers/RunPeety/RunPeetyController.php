<?php

namespace App\Http\Controllers\RunPeety;

use App\Helpers\PlaygroundCryptography;
use App\RunPeetyPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RunPeetyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = RunPeetyPoint::all();

        $json = [
            'data'=> $points
        ];
        return response()->json($json,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $encodedString = $request->input('encodedPoint');
        if($encodedString == ''){
            $json =[
                'Error'=> 'Wrong Format'
            ];
            return response()->json($json,400);
        }

        try{
            /*
            $pass = "lTuJryvmP2UotAIcg6Wnrbu9pkvzyShJzCgRYB1DuLPLboNfkyszxLyMVUbiAjPZJWGvlxWD6Cf7QQbYcroA0KcMscSSjxIQjc9vyVWun1s1GrQGI26zA79T7RBee9Sm";
            $encodedClean = str_replace($pass,"",$encodedString);
            $decoded = base64_decode($encodedClean);
            */
            $crypto = new PlaygroundCryptography();
            $cleanString = $crypto->decrypt($encodedString);

            $json = json_decode($cleanString);

            $dbPoint = new RunPeetyPoint();
            $dbPoint->name = $json->name;
            $dbPoint->points = $json->points;
            $dbPoint->save();

            return response()->json($json,200);
        }catch (Exception $e){
            return response()->json('Fehler:' . $e->getMessage(),400);
        }

    }





}
