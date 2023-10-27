@extends('admin_layout.master')

@section('content')

<div class = "nk-content">
   <table class="table table hover">
    <thead>
        <tr>
            <th scope="col">S.no</th>
            <th scope="col">College name</th>
            <th scope="col">Location</th>
            <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; ?>
        @foreach($college as $data)
         <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $data->college_name }}</td>
            <td>{{ $data->location }}</td>
            <td>
                <a href="{{ url('/admin-dashboard/addcollege/'.$data->slug)}}" class="btn btn-primary"> Edit</a>
            </td>
        </tr>
        @endforeach
      </tbody>
   </table>
</div>

@endsection
