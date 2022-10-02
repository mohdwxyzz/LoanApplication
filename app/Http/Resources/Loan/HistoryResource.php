<?php

namespace App\Http\Resources\Loan;

use Illuminate\Http\Resources\Json\JsonResource;
use \Auth;
use Carbon\Carbon;

class HistoryResource extends JsonResource
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
            'name' => $this->user->name,
            'amount' => '$'.$this->amount,
            'date' =>  Carbon::parse($this->created_at)->format('Y-m-d'),
            'status' => $this->status,
           
        ];
    }
}
