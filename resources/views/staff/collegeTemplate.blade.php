@extends('staff_layout.master')

@section('content')

<div class="nk-block nk-block-lg p-4">

</div>
<div class="card card-bordered card-preview">
    <div class="card-inner">
        <div class="nk-content col-8">
            @if ($message = Session::get('success'))
                <div class="alert alert-success col-lg-6">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form method="post" id="myform" enctype="multipart/form-data" action="{{ url('addTemplate') }}">
                @csrf
                <h4>First Section</h4>
                <div class="form-group">
                    <label class="form-label" for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" value="">
                    @error('logo')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_title">First Section Title</label>
                    <input type="text" class="form-control" id="first_title" name="first_title" value="">
                    @error('first_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_des">First Section description</label>
                    <textarea class="form-control" id="first_des" name="first_des"></textarea>
                    @error('first_des')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_back_img">First Section Background img</label>
                    <input type="file" class="form-control" id="first_back_img" name="first_back_img" value="">
                    @error('first_back_img')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_btn">First Section button text</label>
                    <input type="text" class="form-control" id="first_btn" name="first_btn" value="">
                    @error('first_btn')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Second Section</h4>
                <div class="form-group">
                    <label class="form-label" for="second_text">Second section left textarea</label>
                    <textarea class="form-control" id="second_text" name="second_text"></textarea>
                    @error('second_text')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="second_img">Second Section Right Image</label>
                    <input type="file" class="form-control" id="second_img" name="second_img" value="">
                    @error('second_img')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Third Section</h4>
                <div class="form-group">
                    <label class="form-label" for="third_title">Third Section Title</label>
                    <input type="text" class="form-control" id="third_title" name="third_title" value="">
                    @error('third_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="third_sub_title">Third Section Subtitle</label>
                    <input type="text" class="form-control" id="third_sub_title" name="third_sub_title" value="">
                    @error('third_sub_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="multiimage">
                        
                    <!-- <div>   
                        
                        <img src="" height="100px" width="100px">
                        <button class="btn btn-danger remove" removekey="" btn_id ="" type="button">Remove</button>
                    </div> -->
                </div>
                <br>
                    <button class="btn btn-primary" id="btn" type="button">Add more</button> 
                <br>
                <br>
                <div class="form-group">
                    <label class="form-label" for="third_btn_txt">Third Section Button Text</label>
                    <input type="text" class="form-control" id="third_btn_txt" name="third_btn_txt" value="">
                    @error('third_btn_txt')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Fourth Section</h4>
                <div class="form-group">
                    <label class="form-label" for="fourth_title">Fourth Section Title</label>
                    <input type="text" class="form-control" id="fourth_title" name="fourth_title" value="">
                    @error('fourth_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fourth_des">Fourth Section description</label>
                    <textarea class="form-control" id="fourth_des" name="fourth_des"></textarea>
                    @error('fourth_des')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fourth_btn_txt">Fourth Section Button Text</label>
                    <input type="text" class="form-control" id="fourth_btn_txt" name="fourth_btn_txt" value="">
                    @error('fourth_btn_txt')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fourth_back_img">Fourth Section Background Image</label>
                    <input type="file" class="form-control" id="fourth_back_img" name="fourth_back_img" value="">
                    @error('fourth_back_img')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Fifth Section</h4>
                <div class="form-group">
                    <label class="form-label" for="fifth_title">Fifth Section Title</label>
                    <input type="text" class="form-control" id="fifth_title" name="fifth_title" value="">
                    @error('fifth_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fifth_subtitle">Fifth Section SubTitle</label>
                    <input type="text" class="form-control" id="fifth_subtitle" name="fifth_subtitle" value="">
                    @error('fifth_subtitle')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fifth_text">Fifth Section Textarea</label>
                    <textarea class="form-control" id="fifth_text" name="fifth_text"></textarea>
                    @error('fifth_text')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Last Section</h4>
                <div class="form-group">
                    <label class="form-label" for="last_text">Last Section textarea</label>
                    <textarea class="form-control" id="last_text" name="last_text"></textarea>
                    @error('last_text')
                    {{ 
                        $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fb_link">Last Section FB link</label>
                    <input type="text" class="form-control" id="fb_link" name="fb_link" value="">
                    @error('fb_link')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="twitter_link">Last Section Twitter link</label>
                    <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="">
                    @error('twitter_link')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="insta_link">Last Section Instagram link</label>
                    <input type="text" class="form-control" id="insta_link" name="insta_link" value="">
                    @error('insta_link')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="linkdn_link">Last Section LinkedIn link</label>
                    <input type="text" class="form-control" id="linkdn_link" name="linkdn_link" value="">
                    @error('linkdn_link')
                    {{ $message }}
                    @enderror
                </div>
                   
                <input type="hidden" name="clg_id" id="clg_id" value=" ">
                <input type="hidden" name="aff_by" id="aff_by" value=" ">
                <input type="hidden" name="id" id="id" value=" ">

                <!-- </div> -->
                <input type="submit" value="submit" class="btn btn-primary mt-2" id="submit">
            </form>
        </div>
    </div><!-- .card-preview -->
</div>

<script>
    
    ClassicEditor.create( document.querySelector( '#first_des' ) );   
    ClassicEditor.create( document.querySelector( '#second_text' ) );
    ClassicEditor.create( document.querySelector( '#fourth_des' ) );
    ClassicEditor.create( document.querySelector( '#fifth_text' ) );
    ClassicEditor.create( document.querySelector( '#last_text' ) );

    $('#btn').click(function(e){
        e.preventDefault();
        
        var html = '<div class="form-group"><label class="form-label" for="third_img">Third Section Image</label><input type="file" class="form-control" id="third_img" name="third_img[]" value=""><label class="form-label" for="third_img_txt">Third Section Image Text</label><input type="text" class="form-control" id="third_img_txt" name="third_img_txt[]" value=""></div>';

        $('.multiimage').append(html);
    })

    // $('.remove').click(function(e){
    //     var data = {
    //         id:$(this).attr('btn_id'),
    //         key:$(this).attr('removekey')
    //     }

    //     $.ajax({
    //         url:'./college/remove.php',
    //         type:"post",
    //         data:data,
    //         success:function(response){
    //             NioApp.Toast('Successfully Removed....','info',{position:'top-right'});
               
    //         }
    //     });
    // });

   
</script>

@endsection

