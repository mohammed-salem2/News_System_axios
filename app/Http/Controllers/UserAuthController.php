<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showLogin($guard){
        return response()->view('cms.auth.login' , compact('guard'));
    }

    public function login(Request $request){
        $validator = Validator($request->all(), [
            'email' => 'required|email|string' ,
            'password' => 'required|string|min:6' ,
        ]);
        $credentials = [
            'email' => $request->get('email'),
            'password'=> $request->get('password'),
        ];
        if(! $validator->fails()){
            if(Auth::guard($request->get('guard'))->attempt($credentials)){
                return response()->json(['icon'=>'success' , 'title'=>"Login is done"] , 200);
            }
            else{
                return response()->json(['icon'=> 'error' , 'title' =>"Login is failed"] , 400);
            }
        }
        else {
            return response()->json(['icon'=> 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
        }
    }

    public function logout(Request $request){
        $guard= auth('admin')->check() ? 'admin' : 'author';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('view.login' ,$guard);
    }

    public function changePassword(){

    }

    public function resetPassword(){

    }

    public function editProfile(){

    }

    public function updateProfile(){

    }
}
