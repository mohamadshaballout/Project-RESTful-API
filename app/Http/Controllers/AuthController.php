<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'c_password'=>'required|same:password'
        ]);
        if($validator->fails()){
            return $this->sendError('failed to register',$validator->errors());
        }
    $input =$request->all();
    $nput['password']=Hash::make($input['password']);
    $user=User::create($input);
    $success['token']=$user->createToken('mohamad')->accessToken;
    $success['name']=$user->name;
    return $this->sendResponse($success,'register successfuly');

    }


    public function login(Request $request){
       if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
           $user=Auth::user();
           $success['token']=$user->createToken['mohamad']->accessToken;
           $success['name']=$user->name;
           return $this->sendResponse($success,'login successfuly');
       }else{
           return $this->sendError('unothorised',['errors','unauth']);
       }
    }
}
