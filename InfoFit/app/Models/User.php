<?php
/**
 * @file    User.php
 * @brief   This file is the model linked to the users table of the database
 * @author  Created by Thierry.KOETSCHET
 * @version 11.05.2023
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'lastname',
        'firstname',
        'gender',
        'birthdate',
        'height'
    ];
}
