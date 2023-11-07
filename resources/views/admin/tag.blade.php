@extends('admin_layout.master')

@section('content')

<div class="nk-content">
    <form method="post" id="form1">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="tag_name">Tag Name</label>
                <input type="text" name="tag_name" id="tag_name" class="form-control" value="">
            </div>
            <div class="form-group">
                <label class="form-label" for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
        <input type="hidden" id="tag_id" name="tag_id" value="">
    </form>
    <br>

    <div class="card card-bordered card-preview">
        <table class="table table-tranx" id="table"><table class="table table-tranx" id="table">
            <thead>
                <tr class="tb-tnx-head">
                    <th class="tb-tnx-id"><span class="">#</span></th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Tag Name</span>
                        </span>
                    </th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Slug</span>
                        </span>
                        </th>
                    <th class="tb-tnx-action">
                        <span>Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; ?>
                @foreach($tags as $tag)
                <tr class="tb-tnx-item" id="tag{{ $tag->id ?? ''}}">
                    <td class="tb-tnx-id">
                        <a href="#"><span>{{ $i++ }}</span></a>
                    </td>
                    <td class="tb-tnx-info tag-name{{ $tag->id ?? ''}}">
                        <div class="tb-tnx-desc">
                            <input type="text" data-id="{{ $tag->id }}" class="" value="{{ $tag->name }}" disabled="" style="border: none; background: transparent;">
                        </div>
                    </td>
                    <td class="tb-tnx-info tag-slug{{ $tag->id ?? ''}}">
                        <div class="tb-tnx-desc">
                            <input type="text" data-id="{{ $tag->id }}" class="" value="{{ $tag->slug }}" disabled="" style="border: none; background: transparent;">
                        </div>
                    </td>
                    <td>
                        <div class="dropdown drop"><a class="text-soft=" dropdown-toggle="" btn="" btn-icon="" btn-trigger="" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li><a data-id="{{ $tag->id }}" data-name="{{ $tag->name }}" data-slug="{{ $tag->slug }}" class="edit-tag">Edit</a></li>
                                    <li><a data-id="{{ $tag->id }}" class="remove-tag">Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody> 
        </table>
    </div>
</div>

<script>
    $('#tag_name').on("keyup", function(){
        var tag = $('#tag_name').val();
        const url = tag.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        const slug = $('#slug').val(url);
    });

    $(document).ready(function(){
        $('#form1').submit(function(e){
            e.preventDefault();
            var i='{{ $i }}';
            var data = {
                id:$('#tag_id').val(),
                name:$('#tag_name').val(),
                slug:$('#slug').val(),
                _token:"{{ csrf_token() }}",
            }
            $.ajax({
                url:"{{ url('admin-dashboard/createtag') }}",
                type:"post",
                data:data,
                dataType:"json",
                success:function(response){
                    id = response[0].id;
                    $('#form1')[0].reset();

                    if(response[1] == 'add'){
                        var row = $('<tr class="tb-tnx-item"><td class="tb-tnx-id"><a href="#"><span>'+ +i +'</span></a></td><td class="tb-tnx-info"><div class="tb-tnx-desc"><input type="text" data-id="'+id+'" class="" value="'+response[0].name+'" disabled="" style="border: none; background: transparent;"></div></td><td class="tb-tnx-info"><div class="tb-tnx-desc"><input type="text" data-id="'+id+'" class="" value="'+response[0].slug+'" disabled="" style="border: none; background: transparent;"></div></td><td><div class="dropdown drop"><a class="text-soft=" dropdown-toggle="" btn="" btn-icon="" btn-trigger="" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em><div class="dropdown-menu dropdown-menu-end dropdown-menu-xs"><ul class="link-list-plain"><li><a data-id="'+id+'" data-name="'+response[0].name+'" data-slug="'+response[0].slug+'" class="edit-tag">Edit</a></li><li><a data-id="'+id+'" class="remove-tag">Remove</a></li></ul></div></div></td></tr>');
                        $('tbody').append(row);
                    }
                    if(response[1] == 'edit'){
                        var tag_name = ('<div class="tb-tnx-desc"><input type="text" data-id="'+id+'" class="" value="'+response[0].name+'" disabled="" style="border: none; background: transparent;"></div>')
                        var tag_slug = ('<div class="tb-tnx-desc"><input type="text" data-id="'+id+'" class="" value="'+response[0].slug+'" disabled="" style="border: none; background: transparent;"></div>')
                        $('.tag-name'+id).html(tag_name);
                        $('.tag-slug'+id).html(tag_slug);
                    }
                }
            })
        })
    })

    $('body').delegate('.edit-tag','click', function(){
        var tag_name = $(this).attr('data-name');
        var tag_slug = $(this).attr('data-slug');
        var tag_id = $(this).attr('data-id');
        var name = $('#tag_name').val(tag_name);
        var slug = $('#slug').val(tag_slug);
        var id = $('#tag_id').val(tag_id);
    })

    $('body').delegate('.remove-tag','click', function(){
        var data ={
            id:$(this).attr('data-id'),
            _token:"{{ csrf_token() }}"
        }
        $.ajax({
            url:"{{ url('admin-dashboard/deletetag') }}",
            type:"post",
            data:data,
            dataType:"json",
            success:function(response){
                id = data.id;
                $('#tag'+id).html('');
            }
        })
    })

</script>

@endsection