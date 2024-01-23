<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ApproveUsers;
use App\Models\User; 
use App\Models\Student;
use App\Models\Staff;
use App\Models\Sponsor;
use App\Models\Alumni;
use App\Models\CollegeName;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Media;
use App\Models\Variation;
use Hash;

class AdminController extends Controller
{
    public function admin(){
        return view('admin.index');
    }

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
            'loc' => 'required',
            'slug' => 'unique:college_names,slug'
       ]);

       $college = new CollegeName;
       $college->college_name = $request->clg;
       $college->slug = $request->slug;
       $college->location = $request->loc;
       $college->moderator = $request->mod;
       $college->save();

       return redirect('/admin-dashboard/addcollege')->with('success','Successfully created');
    }

    public function getCollege(CollegeName $college){
        $college = CollegeName::get();
        return view('admin.collegelist',compact('college'));
    }

    public function editCollege(Request $request,$slug){
        $college = CollegeName::where('slug','=',$slug)->first();
        
        $moderator = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.user_id')
            ->join('college_names', 'staff.college_name', '=', 'college_names.id')
            ->select('users.realname', 'staff.*', 'college_names.college_name','college_names.moderator')
            ->where('college_names.slug','=',$slug)
            ->get();

        return view('admin.college',compact('college','moderator'));
    }

    public function updateCollege(Request $request){
        $id = $request->clg_id;
        $college = CollegeName::where('id','=',$id)->first();
        $college->college_name = $request->clg;
        $college->slug = $request->slug;
        $college->location = $request->loc;
        $college->moderator = $request->mod;
        $college->update();

        return redirect('/admin-dashboard/addcollege/'.$college->slug)->with('success','Updated Successfully..');
    }

    public function category(){
        $category = Category::all();
        return view('admin.categories',compact('category'));
    }

    public function createCategory(Request $request){
        if($request->id){
            $request->validate([
                'category' => 'required',
                'slug' => 'required',
            ]);

            $catgry = Category::where('id','=', $request->id)->first(); 
            $catgry->category_name = $request->category;
            $catgry->slug = $request->slug;
            $catgry->update();  
            $status = 'edit';        
        }else{
            $request->validate([
                'category' => 'required',
                'slug' => 'unique:categories,slug',
            ]);
            $catgry = new Category;
            $catgry->category_name = $request->category;
            $catgry->slug = $request->slug;
            $catgry->save();
            $status = 'add';
        }
        
        return response()->json([$catgry,$status]);
    }

    public function deletCategory(Request $request){
        $id = $request->id;
        $category = Category::where('id','=',$id)->delete();

        return response()->json($category);
    }

    public function tag(){
        $tags = Tag::all();

        return view('admin.tag',compact('tags'));
    }

    public function createTag(Request $request){
        if($request->id){
            $request->validate([
                'name' => 'required',
                'slug' => 'required'
            ]);

            $tag = Tag::where('id','=',$request->id)->first();
            $tag->name = $request->name;
            $tag->slug = $request->slug;
            $tag->update();
            $status = 'edit';

        }else{
            $request->validate([
                'name' => 'required',
                'slug' => 'unique:tags,slug'
            ]);
    
            $tag = new Tag;
            $tag->name = $request->name;
            $tag->slug = $request->slug;
            $tag->save();
            $status = 'add';
        }
        
        return response()->json([$tag,$status]);
    }

    public function deleteTag(Request $request){
        $id = $request->id;
        $tag = Tag::where('id','=',$id)->delete();
        return response()->json($tag);
    }

    public function products(){
        $category = Category::get();
        $tag = Tag::get();
        return view('admin.product',compact('category','tag'));
    }

    public function addproducts(Request $request){
        $request->validate([
            'pname' => 'required',
            'pslug' => 'unique:products,slug',
            'category' => 'required',
            'tag' => 'required',
            'price' => 'required',
            'description' => 'required',
            'strength' => 'required',
            'quantity' => 'required',
            'variation_price' => 'required',
            'g_image' => 'required',
        ]);

        // return count($request->strength);
       

        $tag = json_encode($request->tag);

        if($request->hasFile('f_image')) {
            $featureimage = $request->file('f_image');
            $extension = $featureimage->getClientOriginalExtension();
            $imageName =  time().rand(1,50).'.'.$extension;
            $featureimage->move(public_path('images'), $imageName);
        }

        $product = new Product;
        $product->product_name = $request->pname;
        $product->slug = $request->pslug;
        $product->category = $request->category;
        $product->tags = $tag;
        $product->feature_images = $imageName;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        $files = [];
        if($request->hasFile('g_image')){
            for($i=0;$i<count($request->file('g_image'));$i++){
                $file = $request->file('g_image')[$i];
                $name = time().rand(1,50).'.'.$file->extension();
                $file->move(public_path('images'), $name); 
                $path = asset('images/'.$name);
                $files = $name;

                $media = new Media;
                $media->image_name = $files;
                $media->image_path = $path;
                $media->product_id = $product->id;
                $media->save();
            }
        }

        if(isset($request->strength)){
            $strength = $request->strength;
            $quantity = $request->quantity;
            $variation_price = $request->variation_price;

            for($i=0;$i<count($strength);$i++){
                $variation = new Variation;
                $variation->strength = $strength[$i];
                $variation->quantity = $quantity[$i];
                $variation->price = $variation_price[$i];
                $variation->product_id = $product->id;
                $variation->save();
            }
        }
     
        return redirect('/admin-dashboard/product')->with('success','Product Added Successfully..');
    }

    public function getProducts(Product $product){
        $product = Product::get();
        $c_id = $product[0]->category;
        $category = Category::where('id','=',$c_id)->first();
        return view('admin.allProducts',compact('product','category'));
    }

    public function editproducts($slug){
        $category = Category::all();
        $tag = Tag::all();
        $product = Product::where('slug','=',$slug)->with('media','variation')->first();
        return view('admin.product',compact('category','tag','product'));
    }

    public function deleteMedia(Request $request){
        $id = $request->id;
        $media = Media::where('id','=',$id)->delete();
        return response()->json($media);
    }

    public function updateProduct(Request $request){
        $id = $request->p_id;

        if($request->strength != null){
            $strength = $request->strength;
            $quantity = $request->quantity;
            $price = $request->variation_price;

            $variation = Variation::where([['product_id','=',$id],['strength','=',$strength]])->first();

            for($i=0;$i<count($strength);$i++){
                $variation->strength = $strength[$i];
                $variation->quantity = $quantity[$i];
                $variation->price = $price[$i];
                $variation->update();
            }
        }

        $product = Product::where('id','=',$id)->first();

        if($request->hasFile('f_image')){
            $featureimage = $request->file('f_image');
            $extension = $featureimage->getClientOriginalExtension();
            $imageName =  time().rand(1,50).'.'.$extension;
            $featureimage->move(public_path('images'), $imageName);
        }else{
            $imageName = $product->feature_images;
        }
      
        if($request->tag != null){
            $tag = json_encode($request->tag);
        }else{
            $tag = $product->tags;
        }

        $products = Product::where('id','=',$id)->first();
        $products->product_name = $request->pname;
        $products->slug = $request->pslug;
        $products->category = $request->category;
        $products->tags = $tag;
        $products->feature_images = $imageName;
        $products->price = $request->price;
        $products->description = $request->description;
        $products->update();
    
        $files = [];
        if($request->g_image != null){

            $media = Media::where('product_id','=',$id)->first();

            if($media != null){
                if($request->hasFile('g_image')){
                    for($i=0;$i<count($request->file('g_image'));$i++){
                        $file = $request->file('g_image')[$i];
                        $name = time().rand(1,50).'.'.$file->extension();
                        $file->move(public_path('images'), $name); 
                        $path = asset('images/'.$name);
                        $files = $name;
    
                        $media = new Media();
                        $media->image_name = $files;
                        $media->image_path = $path;
                        $media->update();
                    }
                }
            }else{
                if($request->hasFile('g_image')){
                    for($i=0;$i<count($request->file('g_image'));$i++){
                        $file = $request->file('g_image')[$i];
                        $name = time().rand(1,50).'.'.$file->extension();
                        $file->move(public_path('images'), $name); 
                        $path = asset('images/'.$name);
                        $files = $name;
        
                        $medias = new Media;
                        $medias->image_name = $files;
                        $medias->image_path = $path;
                        $medias->product_id = $id;
                        $medias->save();
                    }
                }
            }
        }

        return redirect('/admin-dashboard/product/'.$products->slug)->with("success","Product Updated Successfully");
    }

    public function profile(){
        return view('admin.profile');
    }

    public function accountsetting(){
        return view('admin.accountsetting');
    }

    public function changePassword(){
        return view('admin.changepassword');
    }

    public function password(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if(Hash::check($request->old_password, Auth()->user()->password)){
            if($request->new_password == $request->confirm_password){
                $password = Hash::make($request->new_password);
                $user = User::where('id','=',Auth::user()->id)->first();
                $user->password = $password;
                $user->update();
            
                return back()->with('success','Password Changed Successfully');
            }else{
                return back()->with('error','Password confirmation not matched');
            }
        }else{
            return back()->with('error','Old Password is not matched');
        }
    }
}
