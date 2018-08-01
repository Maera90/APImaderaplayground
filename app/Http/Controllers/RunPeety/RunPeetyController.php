<?php

namespace App\Http\Controllers\RunPeety;

use App\Helpers\PlaygroundCryptography;
use App\RunPeetyPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RunPeetyController extends Controller
{
    private $cryptography;
    public function __construct(){
        $this->cryptography = new PlaygroundCryptography();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = RunPeetyPoint::orderBy('points','desc')->take(100)->get();

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
            
            $cleanString = $this->cryptography->decrypt($encodedString);

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
