<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

// use HasApiTokens;

class LoanRequest extends Model{
	
	
	protected $fillable = ['status','user_id','amount','loan_id','request_date'];

	public function user(){
		return $this->hasOne(User::class,'id','user_id');
	}

	public function history(){
		return $this->hasOne(PaymentHistory::class,'loan_id','id')->orderBy('id','desc');
	}

	public function histories(){
		return $this->hasMany(PaymentHistory::class,'loan_id','id')->orderBy('id','desc');
	}
}
