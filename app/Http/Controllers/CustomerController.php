<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Authen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    protected function redirectPath()
    {
        return session()->put('url.intended', 'home');
    }
    public function login()
    {

        return view('pages.login');
    }

    public function check_login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if ($user) {
            if (Auth::attempt($data)) {
                if (Authen::where('user_id', $user->id)->first()->authenticated == 1) {
                    return redirect()->intended('home');
                } else {
                    Auth::logout();
                    
                    Mail::to($user->email)->send(new SendMail($user));

                    Authen::create([
                        'user_id' => $user->id,
                        'role' => 1
                    ]);
                    return redirect()->back()->with('error', 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra Gmail để kích hoạt tài khoản.');
                }
            } else {
                return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không chính xác!');
            }
        }

        return redirect()->back()->with('error', 'Tài khoản không tồn tại trên hệ thống. Vui lòng kiểm tra lại!');
    }

    public function register()
    {
        return view('pages.register');
    }

    public function check_register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'max:20', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'repassword' => ['required', 'same:password'],
        ]);

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if ($user) {
            Mail::to($user->email)->send(new SendMail($user));

            Authen::create([
                'user_id' => $user->id,
                'role' => 1
            ]);
            return redirect()->back()->with('success', 'Đăng ký thành công. Vui lòng kiểm tra Gmail để kích hoạt tài khoản.');
        }


        // Auth::login(User::where('email', $data['email'])->first());
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('home');
    }

    public function verifyAccount($email)
    {
        $user = User::where('email', $email)->orWhere('email_verified_at', null)->firstOrFail();
        if ($user) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            Authen::where('user_id', $user->id)->update([
                'authenticated' => 1
            ]);
        }
        Auth::login($user);
        return redirect()->route('home');
    }
}
