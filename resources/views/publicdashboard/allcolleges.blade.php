@extends('publicdashboard_layout.master')

@section('content')

<div class="nk-content">
    <!-- {{ $college }} -->
    <table class="table table hover">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope ="col">College Name</th>
                <th scope="col">College Location</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
           @foreach($college as $data)
            <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $data->college_name }}</td>
                <td>{{ $data->location }}</td>
                <td><a href="{{ url('collegetemplates/'.$data->slug ) }}" class="btn btn-primary">View</a></td>
            </tr>
           @endforeach
        </tbody>
    </table>
</div>

@endsection