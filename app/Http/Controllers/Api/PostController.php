<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function register(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|max:200',
            'authorname'=>'required|max:255',

        ]);
        if ($validation->fails()) {
            return response()->json([
                'status'=>422,
                'error'=>$validation->errors(),
            ]);
        }
        $post=new Post();
        $post->name=$request->name;
        $post->authorname=$request->authorname;
        $post->save();

        if($post)
        {
            return response()->json([
                'status' => 200,
                'message' => 'Post Data Saved Successfully',
            ]);
        }else
        {
            return response()->json([
                'status' => 500,
                'message' => 'Post Data Not Saved',
            ]);
        }

    }
}
