<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

// use HasApiTokens;

class PaymentHistory extends Model{
	
	
	protected $fillable = ['status','loan_id','user_id','amount','request_date'];

	public function user(){
		return $this->hasOne(User::class,'id','user_id');
	}
	

}
