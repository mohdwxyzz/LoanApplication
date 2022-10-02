<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use \Request;
use App\Models\User;
class UserRequestValidation extends FormRequest
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
                
                'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6',
                
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
        $user = User::where('email', $this->email)->first();

        $validator->after(function ($validator)use ($user) {   
            if(!$user){
               $validator->errors()->add('email', 'Account does not Exist.');
            }else if (!\Hash::check($this->password, $user->password)) {
                $validator->errors()->add('password', 'Invalid Credential.');

            }

            return;
        });
    }
}
