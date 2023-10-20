<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Hash;

class UserController extends Controller
{
    public function create(){
        return view('register.register');
    }

    public function register(Request $request){
        $request->validate([
            'r_name' => 'required',
            'nick' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'u_name' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $password = Hash::make($request->password);

        $user = new User;
        $user->realname = $request->r_name;
        $user->nickname = $request->nick;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->u_name;
        $user->password = $password;
        $user->user_type = $request->role;   
        $user->save();
        
        return redirect('register')->with('success','Registration successful...');
    }

    public function login(){
        return view('login.login');
    }

    public function signin(Request $request){
        $user = $request->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        if(Auth::attempt($user)){
            $role = Auth::user()->user_type;
            $approve = Auth::user()->is_approved;
            
            if($role == 0){
                return view('admin.index');
            }

            if($role == 1 && $approve == 1){
                return view('student.index');
            }else{
                return redirect('login')->with('error','The user is not approved by admin');
            }
            
            if($role == 2 && $approve == 1){
                return view('staff.index');
            }else{
                return redirect('login')->with('error','The user is not approved by admin');
            } 

            if($role == 3 && $approve == 1){
                return view('sponsor.index');
            }else{
                return redirect('login')->with('error','The user is not approved by admin');
            } 
            
            if($role == 4 && $approve == 1){
                return view('alumni.index');
            }else{
                return redirect('login')->with('error','The user is not approved by admin');
            }
            
        }else{
            return redirect('login')->with('error','The provided credentials do not match our records');
        }
    }

    public function logout(Request $request){
        Auth::logout();

        return redirect('login');
    }
}
