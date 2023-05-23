<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foodstuff extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'kcal_100g',
        'carbohydrates_100g',
        'lipids_100g',
        'proteins_100g'
    ];
}
