@extends('staff_layout.master')

@section('content')

<div class="nk-block nk-block-lg p-4">
   
</div>
<div class="card card-bordered card-preview">
    <div class="card-inner">
        <div class="nk-content col-8">
            @if ($message = Session::get('success'))
                <div class="alert alert-success col-8">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if(isset($template))
                <form method="post" id="myform" enctype="multipart/form-data" action="{{ url('updateTemplate') }}">
                @csrf
            @else
                <form method="post" id="myform" enctype="multipart/form-data" action="{{ url('addTemplate') }}">
            @endif
                @csrf
                <h4>First Section</h4>
                <div class="form-group">
                    <label class="form-label" for="temp_title">Template Title</label>
                    <input type="text" class="form-control" id="temp_title" name="temp_title" value="{{ old('temp_title', $template->template_title ??'') }}">
                    @error('temp_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $template->slug ??'') }}">
                </div>
                @error('slug')
                {{ $message }}
                @enderror
                <div class="form-group">
                    <label class="form-label" for="logo">Logo</label>
                    @isset($template->logo)
                    <img src="{{ asset('/images/'.$template->logo) }}" alt="image">
                    @endisset
                    <input type="file" class="form-control" id="logo" name="logo" value="">
                    @error('logo')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_title">First Section Title</label>
                    <input type="text" class="form-control" id="first_title" name="first_title" value="{{ old('first_title', $template->first_section_title ??'') }}">
                    @error('first_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_des">First Section description</label>
                    <textarea class="form-control" id="first_des" name="first_des">{{ old('first_des', $template->first_section_description ??'') }}</textarea>
                    @error('first_des')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_back_img">First Section Background img</label>
                    @isset($template->first_section_background_img)
                    <img src="{{ asset('/images/'.$template->first_section_background_img) }}" alt="image">
                    @endisset
                    <input type="file" class="form-control" id="first_back_img" name="first_back_img" value="">
                    @error('first_back_img')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_btn">First Section button text</label>
                    <input type="text" class="form-control" id="first_btn" name="first_btn" value="{{ old('first_btn', $template->first_section_button_text ??'') }}">
                    @error('first_btn')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Second Section</h4>
                <div class="form-group">
                    <label class="form-label" for="second_text">Second section left textarea</label>
                    <textarea class="form-control" id="second_text" name="second_text">{{ old('second_text', $template->second_section_left_textarea ??'') }}</textarea>
                    @error('second_text')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="second_img">Second Section Right Image</label>
                    @isset($template->second_section_right_image)
                    <img src="{{ asset('/images/'.$template->second_section_right_image) }}" alt="image">
                    @endisset
                    <input type="file" class="form-control" id="second_img" name="second_img" value="">
                    @error('second_img')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Third Section</h4>
                <div class="form-group">
                    <label class="form-label" for="third_title">Third Section Title</label>
                    <input type="text" class="form-control" id="third_title" name="third_title" value="{{ old('third_title', $template->third_section_title ??'') }}">
                    @error('third_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="third_sub_title">Third Section Subtitle</label>
                    <input type="text" class="form-control" id="third_sub_title" name="third_sub_title" value="{{ old('third_sub_title', $template->third_section_subtitle ??'') }}">
                    @error('third_sub_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="multiimage">
                    @isset($template->third_section_image)   
                    
                    <?php 
                        $third_img = json_decode($template->third_section_image);
                        $third_txt = json_decode($template->third_section_image_txt); 

                        for($i=0;$i<count($third_img);$i++){?>
                        <div>
                            <?php print_r($third_txt[$i]); ?><br>
                            <img src="{{ asset('/images/'.$third_img[$i]) }}" alt="image">
                            <button class="btn btn-danger remove" removekey="{{ $i }}" btn_id ="{{ $template->id }}" type="button">Remove</button><br>
                        
                        </div>
                    <?php    
                        }
                            
                    ?>
                     @endisset
                </div>
                <br>
                    <button class="btn btn-primary" id="btn" type="button">Add more</button> 
                <br>
                <br>
                <div class="form-group">
                    <label class="form-label" for="third_btn_txt">Third Section Button Text</label>
                    <input type="text" class="form-control" id="third_btn_txt" name="third_btn_txt" value="{{ old('third_btn_txt', $template->third_section_button_txt ??'') }}">
                    @error('third_btn_txt')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Fourth Section</h4>
                <div class="form-group">
                    <label class="form-label" for="fourth_title">Fourth Section Title</label>
                    <input type="text" class="form-control" id="fourth_title" name="fourth_title" value="{{ old('fourth_title', $template->fourth_section_title ??'') }}">
                    @error('fourth_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fourth_des">Fourth Section description</label>
                    <textarea class="form-control" id="fourth_des" name="fourth_des">{{ old('fourth_des', $template->fourth_section_description ??'') }}</textarea>
                    @error('fourth_des')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fourth_btn_txt">Fourth Section Button Text</label>
                    <input type="text" class="form-control" id="fourth_btn_txt" name="fourth_btn_txt" value="{{ old('fourth_btn_txt', $template->fourth_section_button_txt ??'') }}">
                    @error('fourth_btn_txt')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fourth_back_img">Fourth Section Background Image</label>
                    @isset($template->fourth_section_background_img	)
                        <img src="{{ asset('/images/'.$template->fourth_section_background_img	) }}" alt="image">
                    @endisset
                    <input type="file" class="form-control" id="fourth_back_img" name="fourth_back_img" value="">
                    @error('fourth_back_img')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Fifth Section</h4>
                <div class="form-group">
                    <label class="form-label" for="fifth_title">Fifth Section Title</label>
                    <input type="text" class="form-control" id="fifth_title" name="fifth_title" value="{{ old('fifth_title', $template->fifth_section_title ??'') }}">
                    @error('fifth_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fifth_subtitle">Fifth Section SubTitle</label>
                    <input type="text" class="form-control" id="fifth_subtitle" name="fifth_subtitle" value="{{ old('fifth_subtitle', $template->fifth_section_subtitle ??'') }}">
                    @error('fifth_subtitle')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fifth_text">Fifth Section Textarea</label>
                    <textarea class="form-control" id="fifth_text" name="fifth_text">{{ old('fifth_text', $template->fifth_section_textarea ??'') }}</textarea>
                    @error('fifth_text')
                    {{ $message }}
                    @enderror
                </div>
                <hr>
                <h4>Last Section</h4>
                <div class="form-group">
                    <label class="form-label" for="last_text">Last Section textarea</label>
                    <textarea class="form-control" id="last_text" name="last_text">{{ old('last_text', $template->last_section_textarea ??'') }}</textarea>
                    @error('last_text')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="fb_link">Last Section FB link</label>
                    <input type="text" class="form-control" id="fb_link" name="fb_link" value="{{ old('fb_link', $template->last_section_fb_link ??'') }}">
                    @error('fb_link')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="twitter_link">Last Section Twitter link</label>
                    <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="{{ old('twitter_link', $template->last_section_twitter_link ??'') }}">
                    @error('twitter_link')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="insta_link">Last Section Instagram link</label>
                    <input type="text" class="form-control" id="insta_link" name="insta_link" value="{{ old('insta_link', $template->last_section_instagram_link ??'') }}">
                    @error('insta_link')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="linkdn_link">Last Section LinkedIn link</label>
                    <input type="text" class="form-control" id="linkdn_link" name="linkdn_link" value="{{ old('linkdn_link', $template->last_section_linkedin_link ??'') }}">
                    @error('linkdn_link')
                    {{ $message }}
                    @enderror
                </div>
                   
                <input type="hidden" name="clg_id" id="clg_id" value=" {{ $users->id ?? ''}}">
                <input type="hidden" name="aff_by" id="aff_by" value=" {{ $users->moderator ?? ''}}">
                <input type="hidden" name="id" id="id" value="{{ $template->id ?? ''}} ">

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

    $('.remove').click(function(e){
        var data = {
            id:$(this).attr('btn_id'),
            key:$(this).attr('removekey'),
            _token:"{{ csrf_token() }}"
        }
        console.log(data);
        $.ajax({
            url:'/remove',
            type:"post",
            data:data,
            success:function(response){
                NioApp.Toast('Successfully Removed....','info',{position:'top-right'});
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        });
    });

    $('#temp_title').on("keyup",function(){
        const title = $('#temp_title').val();
        const url = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        const slug = $('#slug').val(url);

    }) 
   
</script>

@endsection

