<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use Illuminate\Http\Request;
use App\http\Resources\Post as PostResource;
use app\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
class PostController extends BaseController

{

    public function index()
    {
        $posts=Post::all();
        return $this->sendREsponse(PostResource::collection($posts),'user retrived succes');
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError('validate error',$validator->errors());
        }
        $user=Auth::user();
        $input['user_id']=$user->id;
        $post=Post::create($input);
        return $this->sendResponse($post,'post added successfuly');

    }


    public function show(Post $post)
    {
        //
    }


    public function edit(Post $post)
    {
        //
    }


    public function update(Request $request, Post $post)
    {
        //
    }


    public function destroy(Post $post)
    {
        //
    }
}
