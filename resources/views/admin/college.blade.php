@extends('admin_layout.master')

@section('content')

<div class = "nk-content">

    @if ($message = Session::get('success'))
        <div class="alert alert-success col-lg-6">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (isset($college))
        <form action="{{ url('edit') }}" method="post" id="myform">
       @csrf
    @else
        <form action="{{ url('college') }}" method="post" id="myform">
    @endif
        @csrf
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="clg">College Name</label>
                <input type="text" class="form-control" id="clg" name="clg" value="{{ old('clg', $college->college_name ??'') }}">
                @error('clg')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $college->slug ??'') }}">
                @error('slug')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="loc">Location</label>
                <input type="text" class="form-control" id="loc" name="loc" value="{{ old('loc',$college->location ??'') }}">
                @error('loc')
                {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="mod">Moderator</label>
                <select id="mod" name="mod" class="form-control">
                    <option value="">Select</option>
                    @if(isset($moderator))
                        @foreach ($moderator as $data) 
                            @if($data->id == $data->moderator)
                            <option selected value="{{ $data->id }}">{{ $data->realname }}</option>
                            @else
                            <option value="{{ $data->id }}">{{ $data->realname }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                @error('mod')
                {{ $message }}
                @enderror
            </div>
        </div>
        <input type="hidden" value="{{ $college->id ?? '' }}" name="clg_id">
        <input type="submit" value="submit" class="btn btn-primary mt-2" id="submit">
    </form>
</div>

<script>
    $('#clg').on("keyup",function(){
       const clgname = $('#clg').val();
       const url = clgname.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
       const slug = $('#slug').val(url);
    });
</script>

@endsection