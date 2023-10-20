<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Staff;

class StaffController extends Controller
{
    public function staff(Request $request){
        $staff = Staff::where('user_id','=',Auth::user()->id)->first();
        return view('staff.create',compact('staff'));
    }

    public function updateStaff(Request $request){
        $id = $request->user_id;

        if($request->file != '' || $request->file != null){
            $request->validate([
                'file' => 'required|file|mimes:jpeg,png,jpg',
            ]);
    
            $staff = Staff::where('user_id','=',$id)->first();
    
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $fileName);
    
            $staff->about_me = $request->abt_me;
            $staff->pictures = $fileName;
            $staff->position = $request->position;
            $staff->department = $request->dept;
            $staff->social_link = $request->social;
            $staff->college_name = $request->clg;
            $staff->update();
    
            return redirect('staff')->with('success','Successfully updated...');
        }else{
            $request->validate([
                'abt_me' => 'required',
                'position' => 'required',
                'dept' => 'required',
                'social' => 'required'
            ]);
    
            $staff = Staff::where('user_id','=',$id)->first();
    
            $staff->about_me = $request->abt_me;
            $staff->position = $request->position;
            $staff->department = $request->dept;
            $staff->social_link = $request->social;
            $staff->college_name = $request->clg;
            $staff->update();
    
            return redirect('staff')->with('success','Successfully updated...');
        }
    }
}
