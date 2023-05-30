<?php
/**
 * @file    FoodController.php
 * @brief   This file contains all the functions that impact the daily alimentation page and sends requests to the API
 * @author  Created by Thierry.KOETSCHET
 * @version 22.05.2023
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Weight;
use App\Models\Foodstuff;
use App\Models\Users_has_foodstuff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class FoodController extends Controller
{
    //displays all the foodstuffs inserted in the db
    public function showAlimentation() {
        $foodstuffList = [];
        $date = date("Y-m-d");
        //gets all the foodstuffs based on the logged user and today's date
        $list = Users_has_foodstuff::where('users_id', '=', Auth::id())->where('date', '=', $date)->get();

        foreach ($list as $item) {
            $foodstuffs = [
                'id' => $item['id'],
                'title' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('title'),
                'quantity' => $item['quantity'] * 100,
                'calories' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('kcal_100g'),
                'carbohydrates' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('carbohydrates_100g'),
                'lipids' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('lipids_100g'),
                'proteins' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('proteins_100g'),
                'date' => $date,
                'period' => $item['period']
            ];

            //array displayed in the alimentation page
            array_push($foodstuffList, $foodstuffs);
        }

        return view('/alimentation', ['foodstuffList' => $foodstuffList,'date'=>$date]);
    }

    //displays all the foodstuffs inserted in the db based on the selected date
    public function showAlimentationSpecific($id) {
        $foodstuffList = [];
        $list = Users_has_foodstuff::where('users_id', '=', Auth::id())->where('date', '=', $id)->get();

        foreach ($list as $item) {
            $foodstuffs = [
                'id' => $item['id'],
                'title' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('title'),
                'quantity' => $item['quantity'] * 100,
                'calories' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('kcal_100g'),
                'carbohydrates' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('carbohydrates_100g'),
                'lipids' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('lipids_100g'),
                'proteins' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('proteins_100g'),
                'date' => $item['date'],
                'period' => $item['period']
            ];

            array_push($foodstuffList, $foodstuffs);
        }

        return view('alimentation', ['foodstuffList' => $foodstuffList,'date'=>$id,'back'=>'../']);
    }

    //sorts the foodstuffs in the alimentation page based on their period attribute
    public function showAdd(Request $request) {
        if ($request->has('breakfast')) {
            $period = 'breakfast';
        } elseif ($request->has('diner')) {
            $period = 'diner';
        } else {
            $period = 'supper';
        }
        $productSelection = [];
        $date = $request['date'];
        $infos = ['date' => $date, 'period' => $period];

        return view('/add', ['productSelection'=>$productSelection], ['infos' => $infos]);
    }

    //adds the selected foodstuff to the db
    public function addFoodstuff(Request $request) {

        $formFields = $request->validate([
            'code' => 'required',
            'title' => 'required',
            'kcal_100g' => 'required',
            'carbohydrates_100g' => 'required',
            'lipids_100g' => 'required',
            'proteins_100g' => 'required',
            'quantity' => 'required|numeric|between:0,99.99',
            'date' => 'required',
            'period' => 'required'
        ]);

        $foodstuff = new Foodstuff();
        $foodstuff->code = $formFields['code'];
        $foodstuff->title = $formFields['title'];
        $foodstuff->kcal_100g = $formFields['kcal_100g'];
        $foodstuff->carbohydrates_100g = $formFields['carbohydrates_100g'];
        $foodstuff->lipids_100g = $formFields['lipids_100g'];
        $foodstuff->proteins_100g = $formFields['proteins_100g'];

        //checks wether the foodstuff is the db or not and inserts it
        $checkDB = Foodstuff::where('code', '=', $foodstuff->code)->count();
        if ($checkDB == 0) {
            $foodstuff->save();
        }

        //to link the selected foodstuff to the user in question
        $userHasFoodstuff = new Users_has_foodstuff();
        $userHasFoodstuff->users_id = Auth::id();
        $userHasFoodstuff->foodstuffs_id = Foodstuff::where('code', '=', $foodstuff->code)->value('id');
        $userHasFoodstuff->date = $formFields['date'];
        $userHasFoodstuff->quantity = $formFields['quantity'];
        $userHasFoodstuff->period = $formFields['period'];

        $userHasFoodstuff->save();

        return redirect('/alimentation')->with('success', 'Aliment ajouté!');
    }

    //sends the API requests to the online database and translates the data to an array to display in the add page
    public function searchFoodstuff(Request $request) {
        $productName = $request['foodstuff'];
        $date = $request['date'];
        $period = $request['period'];
        $infos = ['date' => $date, 'period' => $period];
        $api = file_get_contents('https://fr.openfoodfacts.org/categorie/'.$productName.'.json');

        if ($api) {
            $json = json_decode($api, true)['products'];
            $products = array_slice($json, 0, 10);
            $productCode = [];
            $productSelection = [];

            foreach ($products as $product) {
                $foodstuff = new Foodstuff();

                $foodstuff->code = $product['code'];

                array_push($productCode, $foodstuff);
            }

            //this loop generates a 10 items array based on the keyword written in the input
            foreach ($productCode as $product) {
                $api = file_get_contents('https://world.openfoodfacts.org/api/v2/product/'.$product->code);
                if ($api) {
                    $json = json_decode($api, true)['product'];

                    $foodstuff = new Foodstuff();

                    $foodstuff->code = $json['code'];
                    $foodstuff->title = $json['product_name_fr'];
                    if (isset($json['nutriments']['energy-kcal_100g'])) {
                        $foodstuff->kcal_100g = $json['nutriments']['energy-kcal_100g'];
                    } else {
                        if (isset($json['nutriments']['energy'])) {
                            $foodstuff->kcal_100g = $json['nutriments']['energy'];
                        } else {
                            $foodstuff->kcal_100g = 0;
                        }
                    }
                    if (isset($json['nutriments']['carbohydrates_100g'])) {
                        $foodstuff->carbohydrates_100g = $json['nutriments']['carbohydrates_100g'];
                    } else {
                        if (isset($json['nutriments']['carbohydrates'])) {
                            $foodstuff->carbohydrates_100g = $json['nutriments']['carbohydrates'];
                        } else {
                            $foodstuff->carbohydrates_100g = 0;
                        }
                    }
                    if (isset($json['nutriments']['fat_100g'])) {
                        $foodstuff->lipids_100g = $json['nutriments']['fat_100g'];
                    } else {
                        if (isset($json['nutriments']['fat'])) {
                            $foodstuff->lipids_100g = $json['nutriments']['fat'];
                        } else {
                            $foodstuff->lipids_100g = 0;
                        }
                    }
                    if (isset($json['nutriments']['proteins_100g'])) {
                        $foodstuff->proteins_100g = $json['nutriments']['proteins_100g'];
                    } else {
                        if (isset($json['nutriments']['proteins'])) {
                            $foodstuff->proteins_100g = $json['nutriments']['proteins'];
                        } else {
                            $foodstuff->proteins_100g = 0;
                        }
                    }

                    array_push($productSelection, $foodstuff);
                }
                else {
                    return back()->withErrors(['message' => 'Le produit recherché n\'existe pas']);
                }
            }
        }
        else {
            return back()->withErrors(['message' => 'Le produit recherché n\'existe pas']);
        }

        return view('/add',['productSelection'=>$productSelection, 'infos'=>$infos]);
    }

    //deletes a foodstuff from the alimentation page
    public function deleteFoodstuff($id, $date) {
        //delete from db
        Users_has_foodstuff::where('id', '=', $id)->delete();

        $foodstuffList = [];
        $list = Users_has_foodstuff::where('users_id', '=', Auth::id())->where('date', '=', $date)->get();

        //regenerates the array to display in the alimentation page
        foreach ($list as $item) {
            $foodstuffs = [
                'id' => $item['id'],
                'title' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('title'),
                'quantity' => $item['quantity'] * 100,
                'calories' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('kcal_100g'),
                'carbohydrates' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('carbohydrates_100g'),
                'lipids' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('lipids_100g'),
                'proteins' => Foodstuff::where('id', '=', $item['foodstuffs_id'])->value('proteins_100g'),
                'date' => $item['date'],
                'period' => $item['period']
            ];

            array_push($foodstuffList, $foodstuffs);
        }

        return view('alimentation', ['foodstuffList' => $foodstuffList,'date'=>$date,'back'=>'../']);
    }
}
