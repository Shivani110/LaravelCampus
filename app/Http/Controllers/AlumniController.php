<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Alumni;
use App\Models\CollegeName;
use Hash;

class AlumniController extends Controller
{
    public function alumniIndex(){
        return view('alumni.index');
    }

    public function alumni(Request $request){
        $alumni = Alumni::where('user_id','=',Auth::user()->id)->first();
        $college = CollegeName::get();
        return view('alumni.create',compact('alumni','college'));
    }

    public function updateAlumni(Request $request){
        $id = $request->user_id;

        if($request->file != '' || $request->file != null){
            $request->validate([
                'file' => 'required|file|mimes:jpeg,png,jpg',
            ]);

            $alumni = Alumni::where('user_id','=',$id)->first();

            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $fileName);

            $alumni->about_me = $request->abt_me;
            $alumni->pictures = $fileName;
            $alumni->social_link = $request->social;
            $alumni->school = $request->graduate;
            $alumni->update();

            return redirect('/alumni-dashboard/alumni')->with('success','Successfully updated...');
        }else {
            $request->validate([
                'abt_me' => 'required',
                'social' => 'required'
            ]);

            $alumni = Alumni::where('user_id','=',$id)->first();

            $alumni->about_me = $request->abt_me;
            $alumni->social_link = $request->social;
            $alumni->school = $request->graduate;
            $alumni->update();

            return redirect('/alumni-dashboard/alumni')->with('success','Successfully updated...');
        }

    }

    public function profile(){
        return view('alumni.profile');
    }

    public function accountsetting(){
        return view('alumni.accountsetting');
    }

    public function changepassword(){
        return view('alumni.changepassword');
    }

    public function updatepassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        if(Hash::check($request->old_password,Auth()->user()->password)){
            if($request->new_password == $request->confirm_password){
                $password = Hash::make($request->new_password);
                $user = User::where('id','=',Auth::user()->id)->first();
                $user->password = $password;
                $user->update();

                return back()->with("success","Password changed successfully");
            }else{
                return back()->with("error","Password confirmation not matched");
            }
        }else{
            return back()->with("error","Old Password not matched");
        }
    }
}
