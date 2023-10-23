<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ApproveUsers;
use App\Models\User; 
use App\Models\Student;
use App\Models\Staff;
use App\Models\Sponsor;
use App\Models\Alumni;
use App\Models\CollegeName;

class AdminController extends Controller
{
    public function getUsers(){
        $users = User::where([
            ['is_admin','=','0'],
            ['is_approved','=','0']
        ])->get();

        return view('admin.users',compact('users'));
    }

    public function approve(Request $request){
        $id = $request->id;
        $users = User::where('id','=',$id)->first();
        $mailData = array(
            $users->realname,
            $users->nickname,
            $users->username
        );
        $mail = Mail::to($users->email)->send(new ApproveUsers($mailData)); 

        $user_type = $users->user_type;

        if($user_type == 1){
            $student = new Student;
            $student->user_id = $id;
            $student->save();

        }else if($user_type == 2){
            $staff = new Staff;
            $staff->user_id = $id;
            $staff->save();

        }else if($user_type == 3){
            $sponsor = new Sponsor;
            $sponsor->user_id = $id;
            $sponsor->save();

        }else if($user_type == 4){
            $alumni = new Alumni;
            $alumni->user_id = $id;
            $alumni->save();

        }
        $users->is_approved = 1;
        $users->update();

        $data = [
            'success' => true,
            'message'=> 'approved users'
          ] ;
          
        return response()->json($data);
    }

    public function disapprove(Request $request){
        $id = $request->id;
        $users = User::where('id','=',$id)->delete();

        $data = [
            'success' => true,
            'message'=> 'disapprove users'
        ] ;
          
        return response()->json($data);
    }

    public function getApprovedUsers(){
        $users = User::where([
            ['is_admin','=','0'],
            ['is_approved','=','1']
        ])->get();

        return view('admin.approvedusers',compact('users'));
    }

    public function deleteusers(Request $request){
        
        $id = $request->id;
        $users = User::where('id','=',$id)->first();
        $user_type = $users->user_type;

        if($user_type == 1){
           $user = User::where('id','=',$id)->delete();
           $student = Student::where('user_id','=',$id)->delete();

        }else if($user_type == 2){
            $user = User::where('id','=',$id)->delete();
            $staff = Staff::where('user_id','=',$id)->delete();

        }else if($user_type == 3){
            $user = User::where('id','=',$id)->delete();
            $sponsor = Sponsor::where('user_id','=',$id)->delete();

        }else if($user_type == 4){
            $user = User::where('id','=',$id)->delete();
            $alumni = Alumni::where('user_id','=',$id)->delete();

        }

        return response()->json($user);
    }

    public function college(Request $request){
        return view('admin.college');
    }

    public function addcollege(Request $request){
       $request->validate([
            'clg' => 'required',
            'loc' => 'required'
       ]);

       $college = new CollegeName;
       $college->college_name = $request->clg;
       $college->location = $request->loc;
       $college->moderator = $request->mod;
       $college->save();

       return redirect('addcollege')->with('success','Successfully created');
    }

    public function getCollege(CollegeName $college){
        $college = CollegeName::get();
        return view('admin.collegelist',compact('college'));
    }

    public function editCollege(Request $request,$id){
        $college = CollegeName::where('id','=',$id)->first();
        
        $moderator = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.user_id')
            ->join('college_names', 'staff.college_name', '=', 'college_names.id')
            ->select('users.realname', 'staff.*', 'college_names.college_name','college_names.moderator')
            ->where('college_names.id','=',$id)
            ->get();
        return view('admin.college',compact('college','moderator'));
    }

    public function updateCollege(Request $request){
        $id = $request->clg_id;
        $college = CollegeName::where('id','=',$id)->first();
        $college->college_name = $request->clg;
        $college->location = $request->loc;
        $college->moderator = $request->mod;
        $college->update();

        return redirect('addcollege/'.$id)->with('success','Updated Successfully..');
    }
}
