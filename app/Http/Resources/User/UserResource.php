<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use \Auth;
class UserResource extends JsonResource
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
            'name'=> @$this->name,
            'access_token' =>  $this->createToken('loan')->accessToken,
        ];
    }
}
