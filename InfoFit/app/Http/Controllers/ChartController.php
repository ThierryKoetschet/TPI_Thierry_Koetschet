<?php
/**
 * @file    ChartController.php
 * @brief   This file contains all the functions that controle the chart in the IMC page
 * @author  Created by Thierry.KOETSCHET
 * @version 16.05.2023
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    //creates the array that is displayed in the chart
    public function lineChart() {
        $users_id = Auth::id();

        //gets all the weights saved by the user
        $weights = Weight::where('users_id', '=', $users_id)->orderby('updated_at', 'asc')->get();

        $users_height = Auth::user()->height;
        $data = [['Date', 'Poids', 'IMC']];

        foreach ($weights as $weight) {
            //array displayed in the chart
            array_push($data,[$weight->date,$weight['value'], $this->calculateImc($weight['value'], $users_height)]);
        }


        return view('/imc',['data'=>$data]);
    }

    //calcutes the imc of the logged user
    public function calculateImc($weight, $height) {
        $imc = round($weight / (pow($height/100,2)), 1);
        return $imc;
    }

    //calculates the imc of the logged user based on the last weight he had
    public function getLastImc() {
        $users_weight = Weight::where('users_id', '=', Auth::id())->orderby('updated_at', 'desc')->first();
        $users_height = Auth::user()->height;
        $imc = $this->calculateImc($users_weight, $users_height);
        return view('profile',['imc'=>$imc]);
    }
}
