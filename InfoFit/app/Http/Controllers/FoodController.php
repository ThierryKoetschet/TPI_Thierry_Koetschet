<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Weight;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function showAlimentation() {
        return view('/alimentation');
    }

    public function showAdd() {
        $productSelection = [];

        return view('/add',['productSelection'=>$productSelection]);
    }

    public function addFoodstuff() {
        return view('/alimentation');
    }

    public function searchFoodstuff(Request $request) {
        $productName = $request['foodstuff'];
        $json = file_get_contents('https://fr.openfoodfacts.org/categorie/'.$productName.'.json');

        if ($json) {
            $products = json_decode($json, true);
            $productSelection = [];

            $foodstuff = new Food();

        }
        else {
            return back()->withErrors(['message' => 'Le produit recherché n\'existe pas'])->onlyInput('email');
        }

        return view('/add',['productSelection'=>$productSelection]);
    }
}
