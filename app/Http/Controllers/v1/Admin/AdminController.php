<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\v1\User;
use Auth;

class AdminController extends Controller
{
    protected function generateAccessToken($user)
    {
        $token = $user->createToken($user->email.'-'.now());

        return $token->accessToken;
    }
    /**
     * Register
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'f_name' => 'required|alpha|max:255',
            'm_name' => 'required|alpha|max:255',
            'l_name' => 'required|alpha|max:255',
            'age' => 'required|integer|between:18,100',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/|confirmed',
            'password_confirmation' => 'required',
            
        ]);
        $user = User::create([
            'user_info' => json_encode(array(
                'f_name' => $request->f_name,
                'm_name' => $request->m_name,
                'l_name' => $request->l_name,
                'age' => $request->age
            )),
            'role' => 'admin',
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return response()->json($user);
    }
    public function login(Request $request)
    {
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'exists' => 'The :attribute you’ve entered doesn’t match any account.',
        ];
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ], $customMessages);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => array(
                    'email' => array('The password you’ve entered is incorrect. Forgot Password?')
                )
            ], 401);
        } elseif (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken($user->email . '-' . now());
            return response()->json([
                'token' => $token->accessToken,
                'redirect' => Auth::user()->role,
            ]);
        }
    }
    public function account_details(User $user)
    {
        return Auth::user();
    }
}