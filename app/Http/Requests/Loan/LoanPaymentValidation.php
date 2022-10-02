<?php

namespace App\Http\Requests\Loan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use \Request;
use App\Models\LoanRequest;
use App\Models\PaymentHistory;
class LoanPaymentValidation extends FormRequest
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
       $check= LoanRequest::whereUserId(\Auth::id())->orderBy('id','desc')->first();

        $check_payment= self::checkUserPayment($this,$check);
 
        $validator->after(function ($validator)use ($check,$check_payment) {   
            if(@$check->status=='pending'){
               $validator->errors()->add('amount', 'Your loan request is already exist.Your loan request has been sent to the admin and will be approved soon.');
            }else if($check_payment['status']){
               $validator->errors()->add('amount', $check_payment['message']);
            }


            return;
        });
        
    }

    private function checkUserPayment($data,$loan_data){
        $res['status']=false;
        $res['message']='';
        // $check= LoanRequest::whereUserIdAndStatus(\Auth::id())->first();
        if(@$loan_data->status){
            $payment=PaymentHistory::whereUserIdAndLoanId(\Auth::id(),$loan_data->id);
            $count=$payment->count();
            $total_paid_amount=$payment->sum('amount');
            
            if($total_paid_amount && $count > 1){
                $minmum_loan_amount=$loan_data->amount-$total_paid_amount;

               
            }else{
                $minmum_amount=$loan_data->amount-$total_paid_amount;
                $minmum_loan_amount=round($loan_data->amount/3,4);
                if($minmum_loan_amount > $minmum_amount){
                    $minmum_loan_amount=$minmum_amount;
                }

            }

            if($loan_data->amount==$total_paid_amount ){
                 $res['status']=true;
                $res['message']='Your entire loan payment has already been completed.';
            }else if($data->amount > round($loan_data->amount-$total_paid_amount,4) && $total_paid_amount > 1){
               
                $res['status']=true;
                $res['message']='Your loan amount is '.$loan_data->amount-$total_paid_amount.'.So you can pay max';
            }

            else if($data->amount > round($loan_data->amount,4) ){
                $res['status']=true;
                $res['message']='Your loan amount is '.$loan_data->amount.'.So you can pay max';

            }else if($data->amount < round($minmum_loan_amount,4)){
               
                $res['status']=true;
                $res['message']='Minimum payable amount is '.$minmum_loan_amount;
            }
            
       
        }
        return $res;

    }
}
