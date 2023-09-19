<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;

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
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)){
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
        }else{
            return redirect()->back()->with('error', 'Please enter current email all password');
        }
    
    }

    public function forgotpassword(){
        return view('auth.forgot');
    }
    public function PostForgotPassword(Request $request){ 
        $user = User::getEmailSingle($request->email);
        if(!empty($user)){
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
        }else{
            return redirect()->back()->with('error', 'Email not found in the system.');
        }
    }

    public function Logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
