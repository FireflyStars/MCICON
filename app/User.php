<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $fillable = ['firstname', 'lastname', 'email'];
}
