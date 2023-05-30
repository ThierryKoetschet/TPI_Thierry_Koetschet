<?php
/**
 * @file    Weight.php
 * @brief   This file is the model linked to the weights table of the database
 * @author  Created by Thierry.KOETSCHET
 * @version 11.05.2023
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'date',
        'users_id'
    ];
}
