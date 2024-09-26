<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required|min:8',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'error'=>$validator->errors(),
            ]);
        }

        $userdata=new User();
        $userdata->name=$request->name;
        $userdata->email=$request->email;
        $userdata->password=Hash::make($request->password);
        $userdata->save();
        if ($userdata) {
            $tokenResult = $userdata->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;
            return response()->json([
                'status' => 200,
                'accessToken' => $token,
                'message' => 'User Data Saved Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 500,
                'message' => 'User Data Not Saved',
            ]);
        }
    }

    public function userlogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'error'=>$validator->errors(),
            ]);
        }

        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
        return response()->json([
            'status'=>401,
            'message' => 'Unauthorized'
        ]);
        }

        $user = $request->user();
        $userrole = $request->user()->role;
        $tokenResult = $user->createToken($userrole);
        $token = $tokenResult->plainTextToken;

        return response()->json([
        'status'=>200,
        'accessToken' =>$token,
        'token_type' => 'Bearer',
        ]);


    }
}
