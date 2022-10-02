<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

// use HasApiTokens;

class User extends Authenticatable {
	
	use HasApiTokens, Notifiable;
	protected $fillable = [];

}
