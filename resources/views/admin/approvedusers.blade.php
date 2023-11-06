@extends('admin_layout.master')

@section('content')

<div class = "nk-content">
    <!-- <?php print_r($users); ?> -->
   <table class="table table hover">
  
      <thead>
        <tr>
            <th scope="col">S.no</th>
            <th scope="col">Realname</th>
            <th scope="col">Nickname</th>
            <th scope="col">Email</th>
            <th scope="col">Phone number</th>
            <th scope="col">Username</th>
            <th scope="col">Role</th>
            <th scope="col">Is_Approved</th>
            <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php $i=1; ?>
        @foreach($users as $user)
                <tr id="data{{$user->id}}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $user->realname }}</td>
                    <td>{{ $user->nickname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        @if($user->user_type == 1)
                            {{ 'Student' }}
                        @elseif($user->user_type == 2)
                            {{ 'Staff' }}
                        @elseif($user->user_type == 3)
                            {{ 'Sponsor' }}
                        @elseif($user->user_type == 4)
                            {{ 'Alumni' }}   
                        @endif             
                    </td>
                    <td>@if($user->is_approved == 1)
                            {{ 'Approved' }}
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteUsers({{$user->id}})">Delete</button>
                    </td>
                </tr>
        @endforeach
    
      </tbody>
   </table>
</div>

<script>
    function deleteUsers(id){
       Swal.fire({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete',

       }).then((result) => {
            if (result.isConfirmed) {
                var data = {
                    id:id,
                    _token:"{{ csrf_token() }}"
                }
                $.ajax({
                    url:"{{ url('deleteuser') }}",
                    type:'Post',
                    data: data,
                    dataType:'json',
                    success:function(response){
                        if(response){
                            $('#data'+id).hide();
                        }
                        Swal.fire('Deleted', '', 'info')
                    }
                })
            } else if(result.isDenied){
                Swal.fire('Cancelled', '','info');
            }
        });
    }

    
</script>

@endsection
