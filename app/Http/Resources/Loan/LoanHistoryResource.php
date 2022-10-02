<?php

namespace App\Http\Resources\Loan;

use Illuminate\Http\Resources\Json\JsonResource;
use \Auth;
use App\Models\PaymentHistory;
use Carbon\Carbon;
use App\Http\Resources\Loan\HistoryResource;
class LoanHistoryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     
        // dd($this->histories);
        return [
            'id' => $this->id,
            'name'=> @$this->user->name,
            'request_date' =>  $this->request_date,
            'loan_amount' => '$'. $this->amount,
            'status' =>  $this->histories->count() > 2 ? 'completed' :'pending',
            'pending_amount' =>  '$'.$this->amount-$this->histories->sum('amount'),
            'history'=>HistoryResource::collection($this->histories),
        ];

    }
       
}
