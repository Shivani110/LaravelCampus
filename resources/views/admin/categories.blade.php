@extends('admin_layout.master')

@section('content')

<div class = "nk-content">
    <form method="post" id="myform">
    @csrf
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="catgry">Category Name</label>
                <input type="text" name="catgry" id="catgry" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label" for="catgry-slug">Slug</label>
                <input type="text" name="catgry-slug" id="catgry-slug" class="form-control">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
        
    </form>
    <table class="table table hover">
        <tbody>

        </tbody>
    </table>
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
            var data = {
                category:$('#catgry').val(),
                slug:$('#catgry-slug').val(),
                _token:"{{ csrf_token() }}"
            }
            $.ajax({
                url:'/admin-dashboard/createcategory',
                type:'POST',
                data:data,
                dataType:"json",
                success:function(response){
                    $('#myform')[0].reset();
                    
                    var row = $("<tr><td>" 
                        + response.category_name + "</td><td>" 
                        + response.slug + "</td></tr>");

                    $("tbody").append(row);
                }
            });
        });
    });
</script>

@endsection