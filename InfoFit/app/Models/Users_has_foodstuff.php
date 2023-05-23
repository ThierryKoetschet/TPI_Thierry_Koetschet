<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_has_foodstuff extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'foodstuffs_id',
        'date',
        'quantity'
    ];
}
