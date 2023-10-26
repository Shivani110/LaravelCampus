<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\CollegeName;
use App\Models\CollegeTemplate;

class PublicController extends Controller
{
    public function publicDashboard(){
        return view('publicdashboard.index');
    }

    public function getCollegename(CollegeName $college){
        $college = CollegeName::get();
        return view('publicdashboard.allcolleges', compact('college'));
    }

    public function getTemplate(CollegeTemplate $clgtemplate, $id){
        $clgtemplate = CollegeTemplate::where('clg_id','=',$id)->get();
        return view('publicdashboard.collegetemplates', compact('clgtemplate'));
    }

    public function viewTemplate(CollegeTemplate $clgtemplate, $id){
        $clgtemplate = CollegeTemplate::where('id','=',$id)->first();
        return view('publicdashboard.viewtemplate', compact('clgtemplate'));
    }

}
