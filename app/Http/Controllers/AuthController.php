<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function Login(){
        if (!empty(Auth::check())){
            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3){
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4){
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }
    public function AuthLogin(Request $request){
        // dd($request->all());
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->username, 'password' => $request->password], $remember)){
            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3){
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4){
                return redirect('parent/dashboard');
            }
        }else if(Auth::attempt(['nis' => $request->username, 'password' => $request->password], $remember)){
            if(Auth::user()->user_type == 3){
                return redirect('student/dashboard');
            }
        }else{
            return redirect()->back()->with('error', 'Silakan masukkan email saat ini semua kata sandi');
        }
    
    }

    public function forgotpassword(){
        return view('auth.forgot');
    }
    public function PostForgotPassword(Request $request){ 
        $user = User::getEmailSingle($request->email);
        if(!empty($user)){
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', 'Silakan Periksa email Anda dan setel ulang kata sandi Anda.');
        }else{
            return redirect()->back()->with('error', 'Email tidak ditemukan di sistem.');
        }
    }

    public function reset($remember_token){
        $user = User::getTokenSingle($remember_token);
        if(!empty($user)){
            $data['user'] = $user;
            return view('auth.reset', $data);
        }else{
            abort(404);
        }
    }
    public function PostReset($token, Request $request){
        if($request->password == $request->cpassword){
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect('/')->with('success', "Kata sandi berhasil disetel ulang");
        }else{
            return redirect()->back()->with('error', "Kata Sandi dan Konfirmasi Kata Sandi tidak cocok");
        }
    }

    public function Logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
