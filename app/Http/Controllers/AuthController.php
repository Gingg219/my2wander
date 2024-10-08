<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\Auth\RegisteringRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function  register()
    {
        return view('admin.auth.register');
    }

    public function loginHandle(LoginRequest $request) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (Auth::attempt($credentials)) {
            return response()->json([
                'status'  => config('constants.CODE_STATUS.SUCCESS'),
                'title'   => 'LOGIN',
                'message' => 'Welcome to my home',
            ]);
        }
        
        return response()->json([
            'status'  => config('constants.CODE_STATUS.FAIL'),
            'title'   => 'LOGIN',
            'message' => 'Login fail',
        ]);
    }
    public function  callback($provider)
    {
        $data = Socialite::driver($provider)->user();
        $checkExist = true;
        $user = User::query()
            ->where('email', $data->getEmail())
            ->first();
        if (is_null($user)) {
            $user = new User();
            $user->email = $data->getEmail();
            $checkExist = false;
        }
        $user->name = $data->getName();
        $user->save();

        $role=strtolower(UserRole::getKey(intval($user->role)));
        
        Auth::login($user);
        
        if($checkExist){
            return redirect()->route("$role.welcome");
        }
        return redirect()->route('register');
    }

    // public function  registering(RegisteringRequest $request)
    // {
    //     $password = Hash::make($request->password);
    //     if (Auth::check()) {
    //         User::whereId(auth()->user()->id)
    //             ->update([
    //                 'password' => $password,
    //                 'role' => $request->role,
    //             ]);
    //     } else {
    //         $user = User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => $password,
    //             'role' => $request->role,
    //         ]);
    //         Auth::login($user);
    //     }
    //     return response()->json(['data' => "Đăng ký thành công"], 200);
    // }

    public function logOut()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
