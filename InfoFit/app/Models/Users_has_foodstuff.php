<?php
/**
 * @file    Users_has_foodstuff.php
 * @brief   This file is the model linked to the users_has_foodstuffs table of the database
 * @author  Created by Thierry.KOETSCHET
 * @version 22.05.2023
 */

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
