<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Sponsor;

class SponsorController extends Controller
{
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

            return redirect('sponsor')->with('success','Successfully updated...');
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

            return redirect('sponsor')->with('success','Successfully updated...');
        }
    }
}
