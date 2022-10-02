<?php

namespace App\Http\Controllers\API\Loan;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Resources\Loan\LoanResource;
use App\Http\Resources\Loan\LoanHistoryResource;
use Illuminate\Support\Facades\Auth;
use session;
use App\Models\LoanRequest;
use App\Models\PaymentHistory;
use App\Http\Requests\Loan\LoanRequestValidation;
use App\Http\Requests\Loan\LoanPaymentValidation;

class LoanController extends Controller {

	public function loanRequest (LoanRequestValidation $request) {


        $loan=LoanRequest::create([
            'amount'=>$request->amount,
            'user_id'=>\Auth::id(),
            'request_date'=>date('Y-m-d'),
            'status'=>'pending',
        ]);
  
            return $this->returnResponse($status = true, $code = 200, $message = "Loan request submit Successfully", [], $action = json_decode('{}'));
    }

    public function repaymentLoan(LoanPaymentValidation $request) {

        $loan=LoanRequest::with('histories')->whereUserIdAndStatus(\Auth::id(),'approved')->first();
        if($loan->histories->count() > 1 ){
            $loan->status='completed';
            $loan->save();
        }
        $loan=PaymentHistory::create([
            'amount'=>$request->amount,
            'user_id'=>\Auth::id(),
            'loan_id'=>$loan->id,
            'status'=>'paid',
        ]);

    
        return $this->returnResponse($status = true, $code = 200, $message = "Successfully paid",[], $action = json_decode('{}'));
    }

    public function currentLoan(Request $request){

        $loan=LoanRequest::whereUserId(\Auth::id())->where('status','<>','completed')->first();
        

        return $this->returnResponse($status = true, $code = 200, $message = "Current Loan history", new LoanResource($loan), $action = json_decode('{}'));

    }

    public function loanHistory(Request $request){
     $loan=LoanRequest::whereUserId(\Auth::id())->first();

    

        return $this->returnResponse($status = true, $code = 200, $message = "Loan history", new LoanHistoryResource($loan), $action = json_decode('{}'));


    }
}
