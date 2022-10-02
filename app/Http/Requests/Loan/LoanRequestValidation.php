<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use \Request;
use App\Models\LoanRequest;
class LoanRequestValidation extends FormRequest
{

    use \App\Http\Requests\Response;
   
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                
            'amount' => 'required|numeric|min:0.1|between:0.1,9999999.99',

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
        ];
    }
    public function withValidator($validator) 
    {   
       $check= LoanRequest::whereUserIdAndStatus(\Auth::id(),'pending')->orWhere(function($q){
        $q->whereUserIdAndStatus(\Auth::id(),'approved');
       })->first();
        $validator->after(function ($validator)use ($check) {   
            if(@$check->status=='pending' || @$check->status=='approved'){
               $validator->errors()->add('amount', 'Loan request already Exist or pending.Please complete the pending loan first');
            }

            return;
        });
        
    }
}
