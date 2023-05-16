<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function lineChart() {
        $users_id = Auth::id();
        $weights = Weight::where('users_id', '=', $users_id)->orderby('updated_at', 'desc')->get();
        $users_height = Auth::user()->height;
        $data = "";

        foreach ($weights as $weight) {
            $data.="['".$weight->date."',  '".$weight['value']."', '".$this->calculateImc($weight['value'], $users_height)."'],";
        }

        return view('/imc',['data'=>$data]);
    }

    public function calculateImc($weight, $height) {
        $imc = round($weight / (pow($height/100,2)), 1);
        return $imc;
    }

    public function getLastImc() {
        $users_weight = Weight::where('users_id', '=', Auth::id())->orderby('updated_at', 'desc')->first();
        $users_height = Auth::user()->height;
        $imc = $this->calculateImc($users_weight, $users_height);
        return view('profile',['imc'=>$imc]);
    }
}
