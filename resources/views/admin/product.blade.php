@extends('admin_layout.master')

@section('content')

<div class="nk-block nk-block-lg p-4">

</div>

<div class="card card-bordered card-preview">
    <div class="card-inner">
        <div class="nk-content">
            @if ($message = Session::get('success'))
                <div class="alert alert-success col-8">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if(isset($product))
                <form method="post" action="{{ url('admin-dashboard/updateproduct') }}" enctype="mutlipart/form-data">
                @csrf
            @else
                <form method="post" action="{{ url('admin-dashboard/addproduct') }}" enctype="multipart/form-data">
            @endif   
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="pname">Product Name</label>
                            <input type="text" name="pname" id="pname" class="form-control" value="{{ old('pname',$product->product_name ??'')}}">
                            @error('pname')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="pslug">Slug</label>
                            <input type="text" name="pslug" id="pslug" class="form-control" value="{{ old('pslug', $product->slug ??'') }}">
                            @error('pslug')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="category">Category</label>
                            <div class="form-control-wrap">
                                <select class="form-select" id="category" name="category">
                                    <option value="">Select Category</option>
                                    @foreach($category as $catg)
                                        @if(isset($product->category))
                                            @if($product->category == $catg->id)
                                                <option selected value="{{ $catg->id }}">{{ $catg->category_name }}</option>
                                            @else
                                                <option value="{{ $catg->id }}">{{ $catg->category_name }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $catg->id }}">{{ $catg->category_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Tags</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" multiple="multiple" id="tag" name="tag[]">
                                    @foreach($tag as $data)
                                        @if(isset($product->tags))
                                        <?php $p_tag = json_decode($product->tags); ?>
                                            @if(in_array($data->id,$p_tag))
                                                <option selected value="{{ $data->id }}">{{ $data->name }}</option>
                                            @else
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('tag')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="f_image">Feature image</label>
                            <input type="file" name="f_image" id="f_image" class="form-control" value="">
                            @if(isset($product->feature_images))
                                <img src="{{ asset('/images/'.$product->feature_images) }}" alt="">
                            @endif

                            @error('f_image')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="g_image">Gallery Images</label>
                            <input type="file" name="g_image[]" id="g_image" class="form-control" value="" multiple>
                            @if(isset($product->media))
                                @foreach($product->media as $image)
                                <div class="media_img{{$image->id}}">
                                    <img src="{{ asset('/images/'.$image->image_name) }}" alt="" height="80px" width="80px">
                                    <button type="button" class="btn btn-danger remove-btn" img_id="{{ $image->id }}">Remove</button>
                                </div>
                                @endforeach
                            @endif

                            @error('g_image')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control" value="{{ old('price',$product->price ??'') }}">
                            @error('price')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description',$product->description ??'') }}</textarea>
                            @error('description')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-label" for="variation">Variation</label>
                        <div id="vartn">
                            @if(isset($product->variation))
                                @foreach($product->variation as $vratn)
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-control-wrap">
                                            <input type="text" name="strength[]" id="strength{{ $vratn->id }}" class="form-control" placeholder="Strength" value="{{ old('strength[]',$vratn->strength ??'') }}">
                                            @error('strength')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-control-wrap">
                                            <input type="text" name="quantity[]" id="quantity{{ $vratn->id }}" class="form-control" placeholder="Quantity" value="{{ old('quantity[]',$vratn->quantity ??'') }}">
                                            @error('quantity')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-control-wrap">
                                            <input type="text" name="variation_price[]" id="variation_price{{ $vratn->id }}" class="form-control" placeholder="Price" value="{{ old('price[]',$vratn->price ??'') }}">
                                            @error('variation_price')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="button" class="btn btn-primary add-btn">Add</button>
                                        <button type="button" class="btn btn-danger delete-btn" var_id="{{ $vratn->id }}">Delete</button>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-control-wrap">
                                            <input type="text" name="strength[]" id="strength" class="form-control" placeholder="Strength" value="">
                                            @error('strength')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-control-wrap">
                                            <input type="text" name="quantity[]" id="quantity" class="form-control" placeholder="Quantity" value="">
                                            @error('quantity')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-control-wrap">
                                            <input type="text" name="variation_price[]" id="variation_price" class="form-control" placeholder="Price" value="">
                                            @error('variation_price')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="button" class="btn btn-primary add-btn">Add</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="hidden" name="p_id" id="p_id" value="{{ $product->id ?? ''}}">
                <br>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<script>
    $('#pname').keyup(function(){
        const product = $('#pname').val();
        const url = product.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        const slug = $('#pslug').val(url);
        
    })

    $('.add-btn').click(function(){ 
        var html = '<div class="row"><div class="col-lg-3"><div class="form-control-wrap"><input type="text" name="strength[]" id="strength" class="form-control" placeholder="Strength" value=""></div></div><div class="col-lg-3"><div class="form-control-wrap"><input type="text" name="quantity[]" id="quantity" class="form-control" placeholder="Quantity" value=""></div></div><div class="col-lg-3"><div class="form-control-wrap"><input type="text" name="variation_price[]" id="variation_price" class="form-control" placeholder="Price" value=""></div></div></div>';

        $('#vartn').append(html)
    })
       
    $('.remove-btn').click(function(){
        var data={
            id:$(this).attr('img_id'),
            _token:"{{ csrf_token() }}"
        }
        $.ajax({
            url:"{{ url('/admin-dashboard/deletemedia') }}",
            type:"post",
            data:data,
            dataType:"json",
            success:function(response){
                id = data.id;
               $('.media_img'+id).hide();
            }
        }) 
    })
    
    $('.delete-btn').click(function(){
        var id = $(this).attr('var_id');
        var strength = $('#strength'+id).val('');
        var quantity = $('#quantity'+id).val('');
        var price = $('#variation_price'+id).val('');
    })

</script>
@endsection