<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showLogin(Request $request , $guard){

        return response()->view('cms.login',['guard'=>$guard]);

    }

    public function login(Request $request){

        $validator = Validator($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string|min:3|max:30',
            'remember' => 'required|boolean',
            'guard' => 'required|string|in:admin,user'
        ],[
            'guard.in' => 'Please Check Login URL',
        ]);
        if(!$validator->fails()){
            $credentials = [
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ];
            if(Auth::guard($request->get('guard'))->attempt($credentials,$request->get('remember'))){
                return response()->json(['message' => 'Login Successfully'
            ],Response::HTTP_OK);
            }else{
                return response()->json(['message' => 'Faild to login!'
            ],Response::HTTP_BAD_REQUEST);
            }
        }else{
            return response()->json(['message' => $validator->getMessageBag()->first()
          ],Response::HTTP_BAD_REQUEST);
        }

    }

    public function logout(Request $request){
        // auth('admin')->logout();
        if(auth('admin')->check()){
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            return redirect()->route('login','admin');
        }else{
            Auth::guard('user')->logout();
            $request->session()->invalidate();
            return redirect()->route('login','user');
        }
        // Auth::guard('admin')->logout();
        // $request->session()->invalidate();
        // return redirect()->route('login');
    }

    public function editPassword(){
        return response()->view('cms.auth.change-password');
    }
    public function updatePassword(Request $request){

        $guard = auth('admin')->check() ? 'admin' : 'user';

        $validator = Validator($request->all(),[
            'current_password' => "required|string|password:$guard",
            'new_password' => 'required|string|min:7|max:30|confirmed',
        ]);
        if(!$validator->fails()){
            $user = auth($guard)->user();
            $user->password = Hash::make($request->get('new_password'));
            $isSaved = $user->save();
            return response()->json(['message' => $isSaved ? 'Password Changed Successfully' : 'Faild To Change Password'
        ],$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(['message' => $validator->getMessageBag()->first()
        ],Response::HTTP_BAD_REQUEST);
        }

    }

    public function editProfile(){
        $view = auth('admin')->check() ? 'cms.admins.edit' : 'cms.users.edit';
        $guard = auth('admin')->check() ? 'admin' : 'user';
        return response()->view($view,[$guard => auth($guard)->user()]);
    }
    public function updateProfile(){

    }
}
