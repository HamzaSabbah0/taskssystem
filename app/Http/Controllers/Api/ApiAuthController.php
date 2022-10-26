<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    //
    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(),[
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string' //|password:api
    //     ]);
    //     if(!$validator->fails()){
    //         $user = User::where('email',$request->get('email'))->first();
    //         if(Hash::check($request->get('password'),$user->password)){
    //             $this->revokePreviousTokens($user->id);
    //             $token = $user->createToken('User-Api');
    //             // return $token;
    //             $user->setAttribute('token',$token->accessToken);
    //             return response()->json(['message' => 'Logged in Successfully','data' => $user
    //          ],Response::HTTP_OK);
    //         }else{
    //             return response()->json(['message' => 'Wrong Password'
    //          ],Response::HTTP_BAD_REQUEST);
    //         }
    //     }else{
    //         return response()->json(['message' => $validator->getMessageBag()->first()
    //      ],Response::HTTP_BAD_REQUEST);
    //     }
    // }

    public function login(Request $request)
    {
        $validator = Validator($request->all(),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string' //|password:api
        ]);
        if(!$validator->fails()){
            $user = User::where('email',$request->get('email'))->first();
            if(Hash::check($request->get('password'),$user->password)){
                if(!$this->checkForActiveTokens($user->id)){
                    $token = $user->createToken('User-Api');
                    // return $token;
                    $user->setAttribute('token',$token->accessToken);
                    return response()->json(['message' => 'Logged in Successfully','data' => $user
                 ],Response::HTTP_OK);
                }else{
                    return response()->json(['message' => 'Unable to loggin from two devices at the same time'
                 ],Response::HTTP_BAD_REQUEST);
                }
            }else{
                return response()->json(['message' => 'Wrong Password'
             ],Response::HTTP_BAD_REQUEST);
            }
        }else{
            return response()->json(['message' => $validator->getMessageBag()->first()
         ],Response::HTTP_BAD_REQUEST);
        }
    }

    private function revokePreviousTokens($userId)
    {
        DB::table('oauth_access_tokens')
        ->where('user_id',$userId)
        ->update([
            'revoked' => true
        ]);
    }

    private function checkForActiveTokens($userId)
    {
        return DB::table('oauth_access_tokens')
        ->where('user_id',$userId)
        ->where('revoked',false)
        ->exists();
    }

    public function logout()
    {
        $token = auth('api')->user()->token();
        $isRevoked = $token->revoke();
        return response()->json([
            'status' => $isRevoked,
            'message' => $isRevoked ? 'Logged out Successfully' : 'Failed to Logout',
        ], $isRevoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
