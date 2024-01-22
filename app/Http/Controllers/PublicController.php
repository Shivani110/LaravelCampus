<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User; 
use App\Models\CollegeName;
use App\Models\CollegeTemplate;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Product;

class PublicController extends Controller
{
    public function publicDashboard(){
        return view('publicdashboard.index');
    }

    public function getCollegename(CollegeName $college){
        $college = CollegeName::get();
        return view('publicdashboard.allcolleges', compact('college'));
    }

    public function getTemplate(CollegeTemplate $clgtemplate, $slug){
        $clgtemplate = DB::table('college_templates')
            ->join('college_names', 'college_templates.clg_id', '=', 'college_names.id')
            ->where('college_names.slug','=',$slug)
            ->select('college_templates.*')
            ->get();

        return view('publicdashboard.collegetemplates', compact('clgtemplate'));
    }

    public function viewTemplate(CollegeTemplate $clgtemplate, $slug){
        $clgtemplate = CollegeTemplate::where('slug','=',$slug)->first();
        return view('publicdashboard.viewtemplate', compact('clgtemplate'));
    }

    public function getposts($slug){
        $clgtemplate = CollegeTemplate::where('slug','=',$slug)->with('colleges','colleges.posts')->first();

        $id = $clgtemplate->colleges->id;
        $posts = Post::where('clg_id','=',$id)->paginate(4);
        return view('publicdashboard.blogpost',compact('clgtemplate','posts'));
    }

    public function postlikes(Request $request){
        $id = $request->id;
        $userId = $request->userid;
        $posts = Post::where('id','=',$id)->first();
        $like = $posts->likes;
        $likes = json_decode($like);
        $dislike = array();

        if($likes == null){
            if($like == null || $like == ''){
                $likes = array($userId);
            }else{
                array_push($likes,$userId);
            }
            $postlikes = json_encode($likes);
        }else{
            if(in_array($userId,$likes)){
                foreach($likes as $value){
                    if($value == $userId){
                        continue;
                    }
                    array_push($dislike,$value);
                }
                $postlikes = json_encode($dislike);
            }else{
                if($like == null || $like == ''){
                    $likes = array($userId);
                }else{
                    array_push($likes,$userId);
                }
                $postlikes = json_encode($likes);
            }
        }

        $post = Post::where('id','=',$id)->first();
        $post->likes = $postlikes;
        $post->update();

        return response()->json($postlikes);
    }

    public function postcomments(Request $request){
        $request->validate([
            'comment' => 'required',
        ]);
        $comment = new Comment;
        $comment->comments = $request->comment;
        $comment->user_id = $request->userid;
        $comment->post_id = $request->id;
        $comment->comment_type = $request->type;
        $comment->save();

        return response()->json($comment);
    }

    public function replyComments(Request $request){
        $request->validate([
            'reply' => 'required',
        ]);
        $comment = new Comment;
        $comment->comments = $request->reply;
        $comment->user_id = $request->userid;
        $comment->post_id = $request->postid;
        $comment->comment_type = $request->type;
        $comment->reply_id = $request->id;
        $comment->save();

        return response()->json($comment);
    }

    public function searchPost(Request $request){
        $text = $request->search;
        $clg_id = $request->clg_id;
        $post = Post::where('text','LIKE',$text.'%')->where('clg_id','=',$clg_id)->with('commentss.users','commentss.users.students','commentss.users.staff','commentss.users.sponsor','commentss.users.alumni','commentss.reply.users','commentss.reply.users.students','commentss.reply.users.staff','commentss.reply.users.sponsor','commentss.reply.users.alumni')->get();
      
        return response()->json($post);
    }

    public function products(){
        $product = Product::all();
        return view('publicdashboard.product',compact('product'));
    }

    public function productdetails($slug){
        $product = Product::where('slug','=',$slug)->first();
        $pid = $product->id;

        $products = Product::where('id','=',$pid)->with('media','variation')->get();

        return view('publicdashboard.productdetails',compact('products'));
    }
}
