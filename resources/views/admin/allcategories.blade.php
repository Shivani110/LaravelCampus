@extends('admin_layout.master')

@section('content')

<div class="nk-content">
    <table class="table table hover">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        @foreach($category as $data)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $data->category_name }}</td>
                <td><a href="{{ url('/admin-dashboard/createcategory/'.$data->slug) }}" class="btn btn-primary">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection