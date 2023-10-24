<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User; 
use App\Models\Staff;
use App\Models\CollegeName;
use App\Models\CollegeTemplate;

class StaffController extends Controller
{
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

       if(isset($request->third_img)){
            $third_img = $request->third_img;

            for($i=0;$i<count($third_img);$i++){
                $imageName = time() . '.' . $third_img[$i]->extension();
                $third_img[$i]->move(public_path('images'), $imageName);
                array_push($images,$imageName);
            }
       }else{
            $third_img = [];
       }

       $jsonimages = json_encode($images);

       $logo = time() . '.' . $request->logo->extension();
       $request->logo->move(public_path('images'), $logo);

       $firstImage = time() . '.' . $request->first_back_img->extension();
       $request->first_back_img->move(public_path('images'), $firstImage);
   
       $secondImage = time() . '.' . $request->second_img->extension();
       $request->second_img->move(public_path('images'), $secondImage);
    

       $fourthImage = time() . '.' . $request->fourth_back_img->extension();
       $request->fourth_back_img->move(public_path('images'), $fourthImage);  

       $template = new CollegeTemplate;
       $template->template_title = $request->temp_title;
    //    $template->slug = $request->slug;
       $template->logo = $logo;
       $template->first_section_title = $request->first_title;
       $template->first_section_description = $request->first_des;
       $template->first_section_background_img = $firstImage ;
       $template->first_section_button_text = $request->first_btn;
       $template->second_section_left_textarea = $request->second_text;
       $template->second_section_right_image = $secondImage;
       $template->third_section_title = $request->third_title;
       $template->third_section_subtitle = $request->third_sub_title;
       $template->third_section_image = $jsonimages;
       $template->third_section_image_txt = $jsontext;
       $template->third_section_button_txt = $request->third_btn_txt;
       $template->fourth_section_title = $request->fourth_title;
       $template->fourth_section_description = $request->fourth_des;
       $template->fourth_section_button_txt = $request->fourth_btn_txt;
       $template->fourth_section_background_img = $fourthImage;
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
       
       return redirect('collegeTemplate')->with('success','Successfully created...');
    }

    public function getTemplate(){
        $clgtemplate = CollegeTemplate::get();
        return view('staff.templatelist',compact('clgtemplate'));
    }

    public function editTemplate(Request $request,$id){
        $template = CollegeTemplate::where('id','=',$id)->first();
        return view('staff.collegeTemplate',compact('template'));

    }

    public function updateTemplate(Request $request){
        // print_r($request->all());
        $id = $request->id;
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

        if(isset($request->third_img)){
            $third_img = $request->third_img;

            for($i=0;$i<count($third_img);$i++){
                $imageName = time() . '.' . $third_img[$i]->extension();
                $third_img[$i]->move(public_path('images'), $imageName);
                array_push($thirdimg,$imageName);
            }
       }else{
            $third_img = $clgtemplate->third_section_image;
       }

       $jsonimages = json_encode($thirdimg);

       if($request->logo != null){
            $logo = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('images'), $logo);
        }else{
            $logo = $clgtemplate->logo;
        }

        if($request->first_back_img != null){
            $firstImage = time() . '.' . $request->first_back_img->extension();
            $request->first_back_img->move(public_path('images'), $firstImage);
        }else{
            $firstImage = $clgtemplate->first_section_background_img;
        }

        if($request->second_img != null){
            $secondImage = time() . '.' .$request->second_img->extension();
            $request->second_img->move(public_path('images'), $secondImage);
        }else{
            $secondImage = $clgtemplate->second_section_right_image;
        }

        if($request->fourth_back_img != null){
            $fourthImage = time() . '.' .$request->fourth_back_img->extension();
            $request->fourth->back_img->move(public_path('images'), $fourthImage);
        }else{
            $fourthImage = $clgtemplate->fourth_section_background_img;
        }
        
       $template = CollegeTemplate::where('id','=',$id)->first();
       $template->logo = $logo;
       $template->first_section_title = $request->first_title;
       $template->first_section_description = $request->first_des;
       $template->first_section_background_img = $firstImage ;
       $template->first_section_button_text = $request->first_btn;
       $template->second_section_left_textarea = $request->second_text;
       $template->second_section_right_image = $secondImage;
       $template->third_section_title = $request->third_title;
       $template->third_section_subtitle = $request->third_sub_title;
       $template->third_section_image = $jsonimages;
       $template->third_section_image_txt = $jsontext;
       $template->third_section_button_txt = $request->third_btn_txt;
       $template->fourth_section_title = $request->fourth_title;
       $template->fourth_section_description = $request->fourth_des;
       $template->fourth_section_button_txt = $request->fourth_btn_txt;
       $template->fourth_section_background_img = $fourthImage;
       $template->fifth_section_title = $request->fifth_title;
       $template->fifth_section_subtitle = $request->fifth_subtitle;
       $template->fifth_section_textarea = $request->fifth_text;
       $template->last_section_textarea = $request->last_text;
       $template->last_section_fb_link = $request->fb_link;
       $template->last_section_twitter_link = $request->twitter_link;
       $template->last_section_instagram_link = $request->insta_link;
       $template->last_section_linkedin_link = $request->linkdn_link;
       $template->update();
       
       return redirect('collegeTemplate/'.$id)->with('success','Successfully Updated...');
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
}
