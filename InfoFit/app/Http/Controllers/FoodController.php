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
        $foodstuffList = [];
        $list = Users_has_foodstuff::where('users_id', '=', Auth::id())->get();

        foreach ($list as $item) {
            $foodstuffs = [
                'title' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('title'),
                'quantity' => $item['quantity'] * 100,
                'calories' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('kcal_100g'),
                'carbohydrates' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('carbohydrates_100g'),
                'lipids' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('lipids_100g'),
                'proteins' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('proteins_100g'),
                'date' => $item['date']
            ];

            array_push($foodstuffList, $foodstuffs);
        }

        return view('/alimentation', ['foodstuffList' => $foodstuffList]);
    }

    public function showAdd(Request $request) {
        $productSelection = [];
        $date = $request['date'];


        return view('/add', ['productSelection'=>$productSelection], ['date' => $date]);
    }

    public function addFoodstuff(Request $request) {
        $formFields = $request->validate([
            'code' => 'required',
            'title' => 'required',
            'kcal_100g' => 'required',
            'carbohydrates_100g' => 'required',
            'lipids_100g' => 'required',
            'proteins_100g' => 'required',
            'quantity' => 'required|numeric|between:0,99.99',
            'date' => 'required'
        ]);

        $foodstuff = new Foodstuff();
        $foodstuff->code = $formFields['code'];
        $foodstuff->title = $formFields['title'];
        $foodstuff->kcal_100g = $formFields['kcal_100g'];
        $foodstuff->carbohydrates_100g = $formFields['carbohydrates_100g'];
        $foodstuff->lipids_100g = $formFields['lipids_100g'];
        $foodstuff->proteins_100g = $formFields['proteins_100g'];

        $checkDB = Foodstuff::where('code', '=', $foodstuff->code)->count();

        if ($checkDB == 0) {
            $foodstuff->save();
        }

        $userHasFoodstuff = new Users_has_foodstuff();
        $userHasFoodstuff->users_id = Auth::id();
        $userHasFoodstuff->foodstuffs_id = Foodstuff::where('code', '=', $foodstuff->code)->value('id');
        $userHasFoodstuff->date = $formFields['date'];
        $userHasFoodstuff->quantity = $formFields['quantity'];

        $userHasFoodstuff->save();

        return redirect('/alimentation')->with('success', 'Aliment ajouté!');
    }

    public function searchFoodstuff(Request $request) {
        $productName = $request['foodstuff'];
        $api = file_get_contents('https://fr.openfoodfacts.org/categorie/'.$productName.'.json');

        if ($api) {
            $json = json_decode($api, true)['products'];
            $products = array_slice($json, 0, 5);
            $productCode = [];
            $productSelection = [];

            foreach ($products as $product) {
                $foodstuff = new Foodstuff();

                $foodstuff->code = $product['code'];

                array_push($productCode, $foodstuff);
            }

            foreach ($productCode as $product) {
                $api = file_get_contents('https://world.openfoodfacts.org/api/v2/product/'.$product->code);
                $json = json_decode($api, true)['product'];

                $foodstuff = new Foodstuff();

                $foodstuff->code = $json['code'];
                $foodstuff->title = $json['product_name_fr'];
                $foodstuff->kcal_100g = $json['nutriments']['energy-kcal_100g'];
                $foodstuff->carbohydrates_100g = $json['nutriments']['carbohydrates_100g'];
                $foodstuff->lipids_100g = $json['nutriments']['fat_100g'];
                $foodstuff->proteins_100g = $json['nutriments']['proteins_100g'];

                array_push($productSelection, $foodstuff);
            }
        }
        else {
            return back()->withErrors(['message' => 'Le produit recherché n\'existe pas'])->onlyInput('email');
        }

        return view('/add',['productSelection'=>$productSelection]);
    }
}
