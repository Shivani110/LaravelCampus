@extends('staff_layout.master')

@section('content')

<div class="nk-content">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
           @foreach($posts as $post)
            <tr>
                <td><img src="{{ asset('/images/'.$post->image) }}" ></td>
                <td>
                    <a href="{{ asset('/staff-dashboard/addposts/'.$post->slug) }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection