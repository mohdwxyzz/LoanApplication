<?php

namespace App\Http\Resources\Loan;

use Illuminate\Http\Resources\Json\JsonResource;
use \Auth;
use App\Models\PaymentHistory;
use Carbon\Carbon;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     
        
        return [
            'id' => $this->id,
            'name'=> @$this->user->name,
            'request_date' =>  $this->request_date,
            'status' =>  $this->histories->count() > 2 ? 'completed' :'pending',
            'pending_amount' => '$'. $this->amount-$this->histories->sum('amount'),
            "next_payment_date"=> self::nextDueDate(),
        ];

    }
        private function nextDueDate(){
           $payment= PaymentHistory::whereLoanIdAndUserId($this->id,\Auth::id())->orderBy('id','desc')->first();
            if($payment){

                return $nextDueDate=Carbon::parse($payment->created_at)->add(7, 'day')->format('Y-m-d');
            }
           return Carbon::parse($this->updated_at)->add(7, 'day')->format('Y-m-d');
        }
}
