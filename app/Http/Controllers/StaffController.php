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
        return view('staff.collegeTemplate');
    }

    public function addtemplate(Request $request){
       $request->validate([
            'logo' => 'required|file|mimes:jpeg,png,jpg',
            'first_title' => 'required',
            'first_des' => 'required',
            'first_back_img' => 'required|file|mimes:jpeg,png,jpg',
            'first_btn' => 'required',
            'second_text' => 'required',
            'second_img' => 'required|file|mimes:jpeg,png,jpg',
            'third_title' => 'required',
            'third_sub_title' => 'required',
            // 'third_img' => 'required|file|mimes:jpeg,png,jpg'
            'third_btn_txt' => 'required',
            'fourth_title' => 'required',
            'fourth_des' => 'required',
            'fourth_btn_txt' => 'required',
            'fourth_back_img' => 'required|file|mimes:jpeg,png,jpg',
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
                $request->third_img->move(public_path('images'), $imageName);
                array_push($images,$imageName);
            }
       }else{
            $third_img = [];
       }

       $jsonimages = json_encode($images);
        // print_r($jsonimages);

       $logo = time() . '.' . $request->logo->extension();
       $request->logo->move(pubic_path('images'), $logo);

       $firstImage = time() . '.' . $request->first_back_img->extension();
       $request->first_back_img->move(public_path('images'), $firstImage);

       $secondImage = time() . '.' . $request->second_img->extension();
       $request->second_img->move(public_path('images'), $secondImage);

       $fourthImage = time() . '.' . $request->fourth_back_img->extension();
       $request->fourth_back_img->move(public_path('images'), $fourthImage);

       $template = new CollegeTemplate;
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
       $template->save();

       return redirect('collegeTemplate')->with('success','Successfully created...');
    }
}
