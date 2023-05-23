<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Weight;
use App\Models\Foodstuff;
use App\Models\Users_has_foodstuff;
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

    public function addFoodstuff(Request $request) {
        $formFields = $request->validate([]);
        $foodstuff = new Foodstuff($formFields);
        $foodstuff->save();

        $userHasFoodstuff = new Users_has_foodstuff();
        $userHasFoodstuff->users_id = Auth::id();
        $userHasFoodstuff->foodstuffs_id = Foodstuff::where('code', '=', $foodstuff->code)->first();
        $userHasFoodstuff->date = date("Y-m-d");
        //$userHasFoodstuff->quantity = ;
    }

    public function searchFoodstuff(Request $request) {
        $productName = $request['foodstuff'];
        $json = file_get_contents('https://fr.openfoodfacts.org/categorie/'.$productName.'.json');

        if ($json) {
            $products = json_decode($json, true)['products'];
            $products = array_slice($products, 0, 5);
            $productCode = [];
            $productSelection = [];

            foreach ($products as $product) {
                $foodstuff = new Foodstuff();

                $foodstuff->code = $product['code'];

                array_push($productCode, $foodstuff);
            }

            foreach ($productCode as $product) {
                $json = file_get_contents('https://world.openfoodfacts.org/api/v2/product/'.$product->code);
                $products = json_decode($json, true)['product'];

                $foodstuff = new Foodstuff();

                $foodstuff->code = $products['code'];
                $foodstuff->title = $products['product_name'];
                $foodstuff->kcal_100g = $products['nutriments']['energy-kcal_100g'];
                $foodstuff->carbohydrates_100g = $products['nutriments']['carbohydrates_100g'];
                $foodstuff->lipids_100g = $products['nutriments']['fat_100g'];
                $foodstuff->proteins_100g = $products['nutriments']['proteins_100g'];

                array_push($productSelection, $foodstuff);
            }
        }
        else {
            return back()->withErrors(['message' => 'Le produit recherché n\'existe pas'])->onlyInput('email');
        }

        return view('/add',['productSelection'=>$productSelection]);
    }
}
