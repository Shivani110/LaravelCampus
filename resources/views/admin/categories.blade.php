@extends('admin_layout.master')

@section('content')

<div class = "nk-content">
    <form method="post" id="myform">
    @csrf
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="catgry">Category Name</label>
                <input type="text" name="catgry" id="catgry" class="form-control" value="">
            </div>
            <div class="form-group">
                <label class="form-label" for="catgry-slug">Slug</label>
                <input type="text" name="catgry-slug" id="catgry-slug" class="form-control" value="">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
       <input type="hidden" id="c_id" name="c_id" value=""> 
    </form>
    <br>

    <div class="card card-bordered card-preview">
        <table class="table table-tranx" id="table"><table class="table table-tranx" id="table">
            <thead>
                <tr class="tb-tnx-head">
                    <th class="tb-tnx-id"><span class="">#</span></th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Category Name</span>
                        </span>
                    </th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Category Slug</span>
                        </span>
                        </th>
                    <th class="tb-tnx-action">
                        <span>Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            <!-- @if(isset($category)) -->
            @foreach($category as $data)                 
            <tr class="tb-tnx-item" id="category{{ $data->id ?? ''}}">
                <td class="tb-tnx-id">
                    <a href="#"><span>{{ $i++ }}</span></a>
                </td>
                <td class="tb-tnx-info c-name{{ $data->id ?? ''}}">
                    <div class="tb-tnx-desc">
                        <input type="text" data-id="{{ $data->id }}" class="" value="{{ $data->category_name }}" disabled="" style="border: none; background: transparent;">
                    </div>
                </td>
                <td class="tb-tnx-info c-slug{{ $data->id ?? ''}}">
                    <div class="tb-tnx-desc">
                        <input type="text" data-id="{{ $data->id }}" class="" value="{{ $data->slug }}" disabled="" style="border: none; background: transparent;">
                    </div>
                </td>
                <td>
                    <div class="dropdown drop"><a class="text-soft=" dropdown-toggle="" btn="" btn-icon="" btn-trigger="" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                            <ul class="link-list-plain">
                                <li><a data-id="{{ $data->id }}" data-name="{{ $data->category_name }}" data-slug="{{ $data->slug }}" class="edit-category">Edit</a></li>
                                <li><a data-id="{{ $data->id }}" class="remove-category">Remove</a></li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            <!-- @endif -->
            </tbody> 
        </table>
    </div>
</div>

<script>
    $('#catgry').on("keyup",function(){
        const category = $('#catgry').val();
        const url = category.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        const slug = $('#catgry-slug').val(url);

    }) 

    $(document).ready(function(){
        $('#myform').submit(function(e){
            e.preventDefault();
            var i = '{{ $i }}';
            var data = {
                id:$('#c_id').val(),
                category:$('#catgry').val(),
                slug:$('#catgry-slug').val(),
                _token:"{{ csrf_token() }}"
            }
            $.ajax({
                url:"{{ url('admin-dashboard/createcategory') }}",
                type:'POST',
                data:data,
                dataType:"json",
                success:function(response){
                    id = response[0].id;
                    dataid = data.id;
                    $('#myform')[0].reset();

                    if(response[1] == 'edit'){
                        var c_name = ('<input type="text" data-id="'+id+'" class="" value="'+response[0].category_name+'" disabled="" style="border: none; background: transparent;">')
                        var c_slug = ('<input type="text" data-id="'+id+'" class="" value="'+response[0].slug+'" disabled="" style="border: none; background: transparent;">')
                        $('.c-name'+id).html(c_name);
                        $('.c-slug'+id).html(c_slug);
                    }

                    if(response[1] == 'add'){
                        var row = $('<tr class="tb-tnx-item"><td class="tb-tnx-id"><a href="#"><span>'+ +i +'</span></a></td><td class="tb-tnx-info"><div class="tb-tnx-desc"><input type="text" data-id="'+id+'" class="" value="'+response[0].category_name+'" disabled="" style="border: none; background: transparent;"></div></td><td class="tb-tnx-info"><div class="tb-tnx-desc"><input type="text" data-id="'+id+'" class="" value="'+response[0].slug+'" disabled="" style="border: none; background: transparent;"></div></td><td><div class="dropdown drop"><a class="text-soft=" dropdown-toggle="" btn="" btn-icon="" btn-trigger="" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em><div class="dropdown-menu dropdown-menu-end dropdown-menu-xs"><ul class="link-list-plain"><li><a data-id="'+id+'" data-name="'+response[0].category_name+'" data-slug="'+response[0].slug+'" class="edit-category">Edit</a></li><li><a href="#" data-id="'+id+'" class="remove-category">Remove</a></li></ul></div></div></td></tr>');
                        $("tbody").append(row);
                    }
                }
            });
        });
    });

    $('body').delegate('.edit-category','click', function(){
        
        var c_name = $(this).attr('data-name');
        var c_slug = $(this).attr('data-slug');
        var c_id = $(this).attr('data-id');
        var name = $('#catgry').val(c_name);
        var slug = $('#catgry-slug').val(c_slug);
        var id = $('#c_id').val(c_id); 

    })

    $('body').delegate('.remove-category','click', function(){
        var data = {
           id:$(this).attr('data-id'),
           _token:"{{ csrf_token() }}"
        }
        $.ajax({
            url:"{{ url('admin-dashboard/deletecategory') }}",
            type:'post',
            data:data,
            dataType:"json",
            success:function(response){
                id = data.id;
                $("#category"+id).html('');
            }
        })
    })

</script>

@endsection