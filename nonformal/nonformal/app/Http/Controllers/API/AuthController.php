<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * Registers a new user and make token
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|string|min:6',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            $this->sendError('Validation Error.', $validator->errors());
            return exit();
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('NonFormal')->accessToken;
        $success['name'] =  $user->name;
        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * authorizes the user and gives a token
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $login = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string',
        ]);

        if($login->fails()){
            $this->sendError('Validation Error.', $login->errors());
            return exit();
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $this->sendError('Invalid login credentials', $login->errors());
            return exit();
        }

        $accessToken = Auth::user()->createToken('NonFormal')->accessToken;

        $success['user'] =  Auth::user();
        $success['token'] =  $accessToken;

        return $this->sendResponse($success, 'User logged in successfully.');
    }
}
