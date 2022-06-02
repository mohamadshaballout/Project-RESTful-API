<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller as Controller;
use Illuminate\http\Request;

class BaseController extends Controller
{
  public function sendResponse($result,$message){
    $response=[
        'success'=>true,
        'data'=>$result,
        'message'=>$message
    ];
    return response()->json($response,200);

  }
  public function sendErroe($error,$errorMessage=[],$code=404){
      $response =[
          'success'=>false,
          'message'=>$error

      ];
      if(!empty($errorMessage)){
          $response['data']=$errorMessage;
      }
      return response()->json($response,$code);

  }
}
