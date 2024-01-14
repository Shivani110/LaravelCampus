<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Sponsor;
use Hash;

class SponsorController extends Controller
{
    public function sponsorIndex(){
        return view('sponsor.index');
    }

    public function sponsor(Request $request){
        $sponsor = Sponsor::where('user_id','=',Auth::user()->id)->first();
        return view('sponsor.create',compact('sponsor'));
    }

    public function updateSponsor(Request $request){
        $id = $request->user_id;
        
        if($request->file != '' || $request->file != null){
            $request->validate([
                'file' => 'required|file|mimes:jpeg,png,jpg',
            ]);

            $sponsor = Sponsor::where('user_id','=',$id)->first();

            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $fileName);

            $sponsor->about_me = $request->abt_me;
            $sponsor->pictures = $fileName;
            $sponsor->type_of_support = $request->support;
            $sponsor->social_link = $request->social;
            $sponsor->update();

            return redirect('/sponsor-dashboard/sponsor')->with('success','Successfully updated...');
        }else{
            $request->validate([
                'abt_me' => 'required',
                'support' => 'required',
                'social' => 'required'
            ]);

            $sponsor = Sponsor::where('user_id','=',$id)->first();

            $sponsor->about_me = $request->abt_me;
            $sponsor->type_of_support = $request->support;
            $sponsor->social_link = $request->social;
            $sponsor->update();

            return redirect('/sponsor-dashboard/sponsor')->with('success','Successfully updated...');
        }
    }

    public function profile(){
        return view('sponsor.profile');
    }

    public function accountsetting(){
        return view('sponsor.accountsetting');
    }
    
    public function changepassword(){
        return view('sponsor.changepassword');
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
