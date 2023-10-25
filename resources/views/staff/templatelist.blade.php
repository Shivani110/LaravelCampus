@extends('staff_layout.master')

@section('content')

<div class="nk-content">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Logo</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- {{ $clgtemplate }} -->
            @foreach($clgtemplate as $clg)
            <tr>
                <td><img src="{{ asset('/images/'.$clg->logo) }}" ></td>
                <td>
                    <a href="{{ url('collegeTemplate/'.$clg->slug) }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection