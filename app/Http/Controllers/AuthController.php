<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['guest'])->except('logout');
    }

    public function login()
    {
        if ($this->request->method() === 'POST') {

            $message = [
                "username.required"    => "Email / username is required",
                "username.exists"      => "Email / username does not exists",
                "password.required" => "Password is required",
//                "password.min"      => "Password must be at least 8 characters",
            ];

            $validator = Validator::make(
                request()->all(),
                [
                    'username'    => 'required|exists:users,username',
                    'password' => 'required',
                ],
                $message
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $credentials = [
                    'username' => $this->postField('username'),
                    'password' => $this->postField('password')
                ];
                if ($this->isAuth($credentials)) {
                    return redirect()->route('dashboard');
                }

                return redirect()->back()->with('failed', 'Periksa Kembali Username dan Password Anda');
            }
        }
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
