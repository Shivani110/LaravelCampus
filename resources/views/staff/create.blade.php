@extends('staff_layout.master')

@section('content')

<div class = "nk-content">
    @if ($message = Session::get('success'))
        <div class="alert alert-success col-lg-6">
            <p>{{ $message }}</p>
        </div>
    @endif
    <form action="{{ url('addstaff') }}" method="post" id="myform" enctype="multipart/form-data">
        @csrf
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="abt_me">About me</label>
                    <textarea class="form-control" id="abt_me" name="abt_me">{{ $staff->about_me }}</textarea>
                    @error('abt_me')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="pic">Pictures</label>
                    @isset($staff->pictures)
                    <img src="{{ asset('/images/'.$staff->pictures) }}" alt="image">
                    @endisset
                    <input type="file" class="form-control" id="file" name="file" value="">
                    @error('file')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="clg">College name</label>
                    <select id="clg" name="clg">
                        <option value="">Select</option>
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="position">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="{{ $staff->position }}">
                    @error('position')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="dept">Department</label>
                    <input type="text" class="form-control" id="dept" name="dept" value="{{ $staff->department }}">
                    @error('dept')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="social">Social Links</label>
                    <input type="text" class="form-control" id="social" name="social" value="{{ $staff->social_link }}">
                    @error('social')
                    {{ $message }}
                    @enderror
                </div>
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            </div>
            <input type="submit" value="Update" class="btn btn-primary mt-2" id="submit">
    </form>
</div>

@endsection
