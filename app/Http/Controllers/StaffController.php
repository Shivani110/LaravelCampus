<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User; 
use App\Models\Staff;
use App\Models\CollegeName;
use App\Models\CollegeTemplate;
use App\Models\Post;
use Hash;

class StaffController extends Controller
{
    public function staffIndex(){
        return view('staff.index');
    }

    public function staff(Request $request){
        $staff = Staff::where('user_id','=',Auth::user()->id)->first();
        $college = CollegeName::get();
        return view('staff.create',compact('staff','college'));
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
    
            return redirect('/staff-dashboard/staff')->with('success','Successfully updated...');
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
    
            return redirect('/staff-dashboard/staff')->with('success','Successfully updated...');
        }
    }

    public function collegetemplate(){
        $userid = Auth::user()->id;
        $users = DB::table('college_names')
            ->join('staff', 'college_names.id', '=', 'staff.college_name')
            ->select('college_names.*')
            ->where('staff.user_id','=',$userid)
            ->first();
        return view('staff.collegeTemplate',compact('users'));
    }

    public function addtemplate(Request $request){
      
       $request->validate([
            'temp_title' => 'required',
            'slug'    =>  'unique:college_templates,slug',
            'first_title' => 'required',
            'first_des' => 'required',
            'first_btn' => 'required',
            'second_text' => 'required',
            'third_title' => 'required',
            'third_sub_title' => 'required',
            'third_btn_txt' => 'required',
            'fourth_title' => 'required',
            'fourth_des' => 'required',
            'fourth_btn_txt' => 'required',
            'fifth_title' => 'required',
            'fifth_subtitle' => 'required',
            'fifth_text' => 'required',
            'last_text' => 'required',
            'fb_link' => 'required',
            'twitter_link' => 'required',
            'insta_link' => 'required',
            'linkdn_link' => 'required',
       ]);
       
     
       $text = array();
        if(isset($request->third_img_txt)){
            $third_img_txt = $request->third_img_txt;

            for($i=0;$i<count($third_img_txt);$i++){
                $imgtxt = $third_img_txt[$i];
                array_push($text,$imgtxt);
            }
        }else{
            $third_img_txt = [];
        }

       $jsontext = json_encode($text);
       
       $images = array();

       if($request->hasFile('third_img')){
            $thirdimage = $request->file('third_img');

            for($i=0;$i<count($thirdimage);$i++){
                $extension = $thirdimage[$i]->getClientOriginalExtension();
                $thirdImageName = 'third_' . rand(0, 1000) . time() . '.' . $extension;
                $thirdimage[$i]->move(public_path('images'), $thirdImageName);
                array_push($images,$thirdImageName);
            }
       }else{
            $thirdimage = [];
       }

       $jsonimages = json_encode($images);

        if($request->hasFile('logo')) {
            $logoimage = $request->file('logo');
            $extension = $logoimage->getClientOriginalExtension();
            $logoImageName = 'logo_' . rand(0, 1000) . time() . '.' . $extension;
            $logoimage->move(public_path('images'), $logoImageName);
        }

        if($request->hasFile('first_back_img')) {
            $firstimage = $request->file('first_back_img');
            $extension = $firstimage->getClientOriginalExtension();
            $firstImageName = 'first_' . rand(0, 1000) . time() . '.' . $extension;
            $firstimage->move(public_path('images'), $firstImageName);
        }

        if($request->hasFile('second_img')) {
            $secondimage = $request->file('second_img');
            $extension = $secondimage->getClientOriginalExtension();
            $secondImageName = 'second_' . rand(0, 1000) . time() . '.' . $extension;
            $secondimage->move(public_path('images'), $secondImageName);
        }
        
        if($request->hasFile('fourth_back_img')) {
            $fourthimage = $request->file('fourth_back_img');
            $extension = $fourthimage->getClientOriginalExtension();
            $fourthImageName = 'fourth' . rand(0, 1000) . time() . '.' . $extension;
            $fourthimage->move(public_path('images'), $fourthImageName);
        }

       $template = new CollegeTemplate;
       $template->template_title = $request->temp_title;
       $template->slug = $request->slug;
       $template->logo = $logoImageName;
       $template->first_section_title = $request->first_title;
       $template->first_section_description = $request->first_des;
       $template->first_section_background_img = $firstImageName;
       $template->first_section_button_text = $request->first_btn;
       $template->second_section_left_textarea = $request->second_text;
       $template->second_section_right_image = $secondImageName;
       $template->third_section_title = $request->third_title;
       $template->third_section_subtitle = $request->third_sub_title;
       $template->third_section_image = $jsonimages;
       $template->third_section_image_txt = $jsontext;
       $template->third_section_button_txt = $request->third_btn_txt;
       $template->fourth_section_title = $request->fourth_title;
       $template->fourth_section_description = $request->fourth_des;
       $template->fourth_section_button_txt = $request->fourth_btn_txt;
       $template->fourth_section_background_img = $fourthImageName;
       $template->fifth_section_title = $request->fifth_title;
       $template->fifth_section_subtitle = $request->fifth_subtitle;
       $template->fifth_section_textarea = $request->fifth_text;
       $template->last_section_textarea = $request->last_text;
       $template->last_section_fb_link = $request->fb_link;
       $template->last_section_twitter_link = $request->twitter_link;
       $template->last_section_instagram_link = $request->insta_link;
       $template->last_section_linkedin_link = $request->linkdn_link;
       $template->clg_id = $request->clg_id;
       $template->affilated_by = $request->aff_by;
       $template->save();

       return redirect('/staff-dashboard/collegeTemplate')->with('success','Successfully created...');
    }

    public function getTemplate(){
        $userid = Auth::user()->id;
        $clgtemplate = DB::table('college_templates')
            ->join('staff', 'college_templates.affilated_by', '=', 'staff.id')
            ->where('staff.user_id','=',$userid)
            ->select('college_templates.*')
            ->get();

        return view('staff.templatelist',compact('clgtemplate'));
    }

    public function editTemplate(Request $request, $slug){
        $template = CollegeTemplate::where('slug','=',$slug)->first();
        return view('staff.collegeTemplate',compact('template'));
        // print_r($slug);
    }

    public function updateTemplate(Request $request){

        // print_r($request->all());
        $id = $request->id;
        $slug = $request->slug;
        $clgtemplate = CollegeTemplate::where('id','=',$id)->first();

        $thirdimg = json_decode($clgtemplate->third_section_image);
        $thirdtxt = json_decode($clgtemplate->third_section_image_txt);

        if(isset($request->third_img_txt)){
            $third_img_txt = $request->third_img_txt;

            for($i=0;$i<count($third_img_txt);$i++){
                $imgtxt = $third_img_txt[$i];
                array_push($thirdtxt,$imgtxt);
            }
        }else{
            $third_img_txt = $clgtemplate->third_section_image_text;
        }

        $jsontext = json_encode($thirdtxt);

        if($request->hasFile('third_img')){
            $thirdimage = $request->file('third_img');

            for($i=0;$i<count($thirdimage);$i++){
                $extension = $thirdimage[$i]->getClientOriginalExtension();
                $thirdImageName = 'third_' . rand(0, 1000) . time() . '.' . $extension;
                $thirdimage[$i]->move(public_path('images'), $thirdImageName);
                array_push($thirdimg,$thirdImageName);
            }
       }else{
            $thirdimage = $clgtemplate->third_section_image;
       }

       $jsonimages = json_encode($thirdimg);


        if($request->hasFile('logo')) {
            $logoimage = $request->file('logo');
            $extension = $logoimage->getClientOriginalExtension();
            $logoImageName = 'logo_' . rand(0, 1000) . time() . '.' . $extension;
            $logoimage->move(public_path('images'), $logoImageName);
        }
        else{
            $logoImageName = $clgtemplate->logo;
        }
            
        if($request->hasFile('first_back_img')) {
            $firstimage = $request->file('first_back_img');
            $extension = $firstimage->getClientOriginalExtension();
            $firstImageName = 'first_' . rand(0, 1000) . time() . '.' . $extension;
            $firstimage->move(public_path('images'), $firstImageName);
        }
        else{
            $firstImageName = $clgtemplate->first_section_background_img;
        }

        if($request->hasFile('second_img')) {
            $secondimage = $request->file('second_img');
            $extension = $secondimage->getClientOriginalExtension();
            $secondImageName = 'second_' . rand(0, 1000) . time() . '.' . $extension;
            $secondimage->move(public_path('images'), $secondImageName);
        }else{
            $secondImageName = $clgtemplate->second_section_right_image;
        }

        if($request->hasFile('fourth_back_img')) {
            $fourthimage = $request->file('fourth_back_img');
            $extension = $fourthimage->getClientOriginalExtension();
            $fourthImageName = 'fourth' . rand(0, 1000) . time() . '.' . $extension;
            $fourthimage->move(public_path('images'), $fourthImageName);
        }
        else{
            $fourthImageName = $clgtemplate->fourth_section_background_img;
        }
        
       $template = CollegeTemplate::where('id','=',$id)->first();
       $template->logo = $logoImageName;
       $template->template_title = $request->temp_title;
       $template->slug = $request->slug;
       $template->first_section_title = $request->first_title;
       $template->first_section_description = $request->first_des;
       $template->first_section_background_img = $firstImageName ;
       $template->first_section_button_text = $request->first_btn;
       $template->second_section_left_textarea = $request->second_text;
       $template->second_section_right_image = $secondImageName;
       $template->third_section_title = $request->third_title;
       $template->third_section_subtitle = $request->third_sub_title;
       $template->third_section_image = $jsonimages;
       $template->third_section_image_txt = $jsontext;
       $template->third_section_button_txt = $request->third_btn_txt;
       $template->fourth_section_title = $request->fourth_title;
       $template->fourth_section_description = $request->fourth_des;
       $template->fourth_section_button_txt = $request->fourth_btn_txt;
       $template->fourth_section_background_img = $fourthImageName;
       $template->fifth_section_title = $request->fifth_title;
       $template->fifth_section_subtitle = $request->fifth_subtitle;
       $template->fifth_section_textarea = $request->fifth_text;
       $template->last_section_textarea = $request->last_text;
       $template->last_section_fb_link = $request->fb_link;
       $template->last_section_twitter_link = $request->twitter_link;
       $template->last_section_instagram_link = $request->insta_link;
       $template->last_section_linkedin_link = $request->linkdn_link;
       $template->update();
       
       return redirect('/staff-dashboard/collegeTemplate/'.$template->slug)->with('success','Successfully Updated...');
    }

    public function removedata(Request $request){
        $id = $request->id;
        $key = $request->key;

        $clgtemplate = CollegeTemplate::where('id','=',$id)->first();

        $image = json_decode($clgtemplate->third_section_image);
        $text = json_decode($clgtemplate->third_section_image_txt);

        $updateimages = array();
        $updatetext = array();

        for($i=0;$i<count($image);$i++){
            if($i == $key){
                continue;
            }
            array_push($updateimages,$image[$i]);
            array_push($updatetext,$text[$i]);
        }
        $img = json_encode($updateimages);
        $txt = json_encode($updatetext);

        $template = CollegeTemplate::where('id','=',$id)->first();
        $template->third_section_image = $img;
        $template->third_section_image_txt = $txt;
        $template->update();

        return response()->json($template);
    }

    public function createpost(){
        $userid = Auth::user()->id;
        $users = DB::table('college_names')
            ->join('staff', 'college_names.id', '=', 'staff.college_name')
            ->select('college_names.*')
            ->where('staff.user_id','=',$userid)
            ->first();

        return view('staff.posts',compact('users'));
    }

    public function addposts(Request $request){
        
        $request->validate([
            'post_title' => 'required',
            'slug' => 'unique:posts,slug',
            'image' => 'required',
            'txt' => 'required',
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = rand(0, 1000) . time() . '.' . $extension;
            $image->move(public_path('images'), $imageName);
        }
        
        $posts = new Post;
        $posts->title = $request->post_title;
        $posts->slug = $request->slug;
        $posts->image = $imageName;
        $posts->text = $request->txt;
        $posts->clg_id = $request->clg_id;
        $posts->save();

        return redirect('/staff-dashboard/addposts')->with('success','Post created successfully');
    }

    public function getposts(){
        $userid = Auth::user()->id;
        $userpost = DB::table('college_names')
            ->join('posts', 'college_names.id', '=', 'posts.clg_id')
            ->join('staff', 'college_names.id', '=', 'staff.college_name')
            ->where('staff.user_id','=',$userid)
            ->select('posts.*')
            ->get();

        return view('staff.allposts',compact('userpost'));
    }

    public function editposts(Request $request, $slug){
        $posts = Post::where('slug','=',$slug)->first();
        return view('staff.posts',compact('posts'));
    }

    public function updateposts(Request $request){
        $id = $request->id;
        $post = Post::where('id','=',$id)->first();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = rand(0, 1000) . time() . '.' . $extension;
            $image->move(public_path('images'), $imageName);
        }
        else{
            $imageName = $post->image;
        }

        $posts = Post::where('id','=',$id)->first();
        $posts->title = $request->post_title;
        $posts->slug = $request->slug;
        $posts->text = $request->txt;
        $posts->image = $imageName;
        $posts->update();

        return redirect('/staff-dashboard/addposts/'.$posts->slug)->with('success','Post Updated');
    }
    
    public function profile(){
        return view('staff.profile');
    }

    public function accountsetting(){
        return view('staff.accountsetting');
    }

    public function changepassword(){
        return view('staff.changepassword');
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
