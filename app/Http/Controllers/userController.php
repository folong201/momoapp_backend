<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\UseUse;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $uservalidate = Validator::make(
                $request->all(),[
                    'username'=>'required',
                    'email'=>'required|email|unique:users,email',
                    'password'=>'required',
                    // 'phone'=>'required'
                ]
                );
                if ($uservalidate->fails()) {
                    return response()->json([
                        'status'=>false,
                        'message'=>"data validation error",
                    ],status:500);
                }else{
                    $user = User::create([
                        'username'=>$request->username,
                        'email'=>$request->email,
                        'password'=>Hash::make($request->password)
                    ]);
                    return response()->json(
                    [   'status'=>true,
                        'message'=>"user created whit success",
                        'token'=>$user->createToken("API TOKEN")->plainTextToken,
                        'user'=>$user
                    ],status:201
                );
                }
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>"and error occure wen try to register",
                'error'=>$th->getMessage()
            ],status:500);
        }
    }

    public function getter(){
        return user::all();
    }

    public function login(Request $request){
        try {
            $uservalidate = Validator::make(
                $request->all(),[
                    'email'=>'required',
                    'password'=>'required',
                ]
                );
                if ($uservalidate->fails()) {
                    return response()->json([
                        'status'=>false,
                        'message'=>"data validation error",
                    ],status:401);
                }else{
                    if (!Auth::attempt($request->only(['email','password']))) {
                        return response()->json(
                            [
                                'ok'=>false,
                                'error'=>true,
                                'message'=>"email or password insorect",
                                'data'=>$request->only['email,password']
                            ],
                            status:500
                        );
                    }
                    else{
                            $user = user::where('email',$request->email)->first();
                            return response()->json(
                        [
                            'status'=>true,
                            'message'=>"user login whit suceess",
                            'token'=>$user->createToken("API TOKEN")->plainTextToken,
                            'user'=>$user
                        ],status:201
                        );
                    }
                }
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>"and error occure wen try to register",
                'error'=>$th->getMessage()
            ],status:500);
        }
    }


}
