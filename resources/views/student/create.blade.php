@extends('student_layout.master')

@section('content')

<div class = "nk-content">
    @if ($message = Session::get('success'))
        <div class="alert alert-success col-lg-6">
            <p>{{ $message }}</p>
        </div>
    @endif
    <form action="{{ url('addstudent') }}"method="post" id="myform" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="abt_me">About me</label>
                <textarea class="form-control" id="abt_me" name="abt_me">{{ $student->about_me }}</textarea>
                @error('abt_me')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="pic">Pictures</label>
                @isset($student->pictures)
                    <img src="{{ asset('/images/'.$student->pictures) }}" alt="image">
                @endisset
                <input type="file" class="form-control" id="file" name="file" value="">
                @error('file')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="course">Course</label>
                <input type="text" class="form-control" id="course" name="course" value="{{ $student->course }}">
                @error('course')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="lev">Level</label>
                <input type="text" class="form-control" id="lev" name="lev" value="{{ $student->level }}">
                @error('lev')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="state">State of origin</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ $student->state_of_origin }}">
                @error('state')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="social">Social Links</label>
                <input type="text" class="form-control" id="social" name="social" value="{{ $student->social_link }}">
                @error('social')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="clg">College name</label>
                <select id="clg" name="clg">
					<option value="">Select</option>
                    <option value=""></option> 
                <select>
                @error('clg')
                {{ $message }}
                @enderror
            </div>
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
        </div>
        <input type="submit" value="Update" class="btn btn-primary mt-2" id="submit">
    </form>
</div>

@endsection
