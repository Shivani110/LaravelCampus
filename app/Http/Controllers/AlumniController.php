<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Alumni;
use App\Models\CollegeName;

class AlumniController extends Controller
{
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
}
