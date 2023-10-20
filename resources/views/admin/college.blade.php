@extends('admin_layout.master')

@section('content')

<div class = "nk-content">
    @if ($message = Session::get('success'))
        <div class="alert alert-success col-lg-6">
            <p>{{ $message }}</p>
        </div>
    @endif
    <form action="{{ url('college') }}" method="post" id="myform">
        @csrf
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="clg">College Name</label>
                <input type="text" class="form-control" id="clg" name="clg" value="" placeholder="College name">
                @error('clg')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="loc">Location</label>
                <input type="text" class="form-control" id="loc" name="loc" value="" placeholder="Location">
                @error('loc')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="mod">Moderator</label>
                <select id="mod" name="mod" class="form-control">
                    <option value="">Select</option>
                </select>
                @error('mod')
                {{ $message }}
                @enderror
            </div>
        </div>
        <input type="submit" value="submit" class="btn btn-primary mt-2" id="submit">
    </form>
</div>

@endsection