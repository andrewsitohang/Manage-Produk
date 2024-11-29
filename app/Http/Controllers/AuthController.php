<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        $title = "Login - SIMS Webp App";
        return view("auth.login",compact('title'));
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'))->with('success',"Logged out successfully");
    }

    public function loginProcess(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return redirect(route('product.index'));
        }else{
            return redirect()->back()->withErrors(["error" => "Invalid credentials, please check again!"]);
        }
    }

    public function profile(){
        $title = "Profile - SIMS Webp App";
        $active = "profile";
        return view("profile.index",compact('title',"active"));
    }
}
