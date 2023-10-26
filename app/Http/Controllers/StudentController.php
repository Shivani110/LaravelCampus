<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Student;

class StudentController extends Controller
{
    public function student(Request $request){
        $student = Student::where('user_id','=',Auth::user()->id)->first();
        return view('student.create',compact('student'));
    }

    public function updateStudent(Request $request){
        $id = $request->user_id;

        if($request->file != '' || $request->file != null){
            $request->validate([
               'file' => 'required|file|mimes:jpeg,png,jpg',
            ]);
    
            $student = Student::where('user_id','=',$id)->first();
    
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $fileName);
    
            $student->about_me = $request->abt_me;
            $student->pictures = $fileName;
            $student->course =  $request->course;
            $student->level = $request->lev;
            $student->state_of_origin = $request->state;
            $student->social_link = $request->social;
            $student->college_name = $request->clg;
            $student->update();
    
            return redirect('/student-dashboard/student')->with('success','Successfully updated...');
        }else{
            $request->validate([
                'abt_me' => 'required',
                'course' => 'required',
                'lev' => 'required',
                'state' => 'required',
                'social' => 'required'
            ]);
    
            $student = Student::where('user_id','=',$id)->first();
    
            $student->about_me = $request->abt_me;
            $student->course =  $request->course;
            $student->level = $request->lev;
            $student->state_of_origin = $request->state;
            $student->social_link = $request->social;
            $student->college_name = $request->clg;
            $student->update();
    
            return redirect('/student-dashboard/student')->with('success','Successfully updated...');
        }
       
    }
}
