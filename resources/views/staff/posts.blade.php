@extends('staff_layout.master')

@section('content')

<div class="nk-content">
@if ($message = Session::get('success'))
        <div class="alert alert-success col-lg-6">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if(isset($posts))
        <form action="" method="post" id="myform" enctype="multipart/form-data">
        @csrf
    @else
        <form action="{{ url('posts') }}" method="post" id="myform" enctype="multipart/form-data">
    @endif
        @csrf
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="post_title">Post Title</label>
                    <input type="text" name="post_title" id="post_title" class="form-control" value="{{ old('post_title', $posts->title ??'') }}">
                    @error('post_title')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $posts->slug ?? '') }}">
                    @error('slug')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control" value="">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="txt">Text</label>
                    <input type="text" name="txt" id="txt" class="form-control" value="{{ old('txt', $posts->text ?? '') }}">
                    @error('txt')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <input type="hidden" name="clg_id" id="clg_id" value="{{ $users->id ?? ''}}">
            <input type="hidden" name="id" id="id" value="{{ $posts->text ?? ''}}">
            <input type="submit" value="Submit" class="btn btn-primary mt-2" id="submit">
    </form>
</div>

<script>
    $('#post_title').on("keyup",function(){
       const title = $('#post_title').val();
       const url = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
       const slug = $('#slug').val(url);
    })
</script>
@endsection