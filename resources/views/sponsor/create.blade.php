@extends('sponsor_layout.master')

@section('content')

<div class = "nk-content">
    @if ($message = Session::get('success'))
        <div class="alert alert-success col-lg-6">
            <p>{{ $message }}</p>
        </div>
    @endif
    <form action="{{ url('addsponsor') }}" method="post" id="myform" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="abt_me">About me</label>
                <textarea class="form-control" id="abt_me" name="abt_me">{{ $sponsor->about_me }}</textarea>
                @error('abt_me')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="pic">Pictures</label>
                @isset($sponsor->pictures)
                <img src="{{ asset('/images/'.$sponsor->pictures) }}" alt="image">
                @endisset
                <input type="file" class="form-control" id="file" name="file" value="">
                @error('file')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="support">Types of Support</label>
                <input type="text" class="form-control" id="support" name="support" value="{{ $sponsor->type_of_support }}">
                @error('support')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="social">Social Links</label>
                <input type="text" class="form-control" id="social" name="social" value="{{ $sponsor->social_link }}">
                @error('social')
                {{ $message }}
                @enderror
            </div>

            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" id="user_id">
            <input type="submit" value="submit" class="btn btn-primary mt-2" id="submit">
        </div>
    </form>
</div>

@endsection
