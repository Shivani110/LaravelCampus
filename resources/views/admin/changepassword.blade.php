@extends('admin_layout.master')

@section('content')

<div class = "nk-content">

    @if ($message = Session::get('success'))
        <div class="alert alert-success col-lg-6">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger col-lg-6">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ url('admin-dashboard/password') }}" method="post" id="myform">
        @csrf
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="old_password">Old Password</label>
                <input type="password" class="form-control" id="old_password" name="old_password" value="">
                @error('old_password')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" value="">
                @error('new_password')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="">
                @error('confirm_password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <input type="submit" value="Save" class="btn btn-primary mt-2" id="submit">
    </form>
</div>


@endsection