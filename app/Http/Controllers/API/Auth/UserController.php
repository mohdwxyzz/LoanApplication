<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;
use session;
use App\Models\User;
use App\Http\Requests\Users\UserRequestValidation;

class UserController extends Controller {
	
	public function login (UserRequestValidation $request) {
    
    $user = User::where('email', $request->email)->first();

   
        \Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
   
     return $this->returnResponse($status = true, $code = 200, $message = "Login Successfully", new UserResource($user), $action = json_decode('{}'));
}

	
}
