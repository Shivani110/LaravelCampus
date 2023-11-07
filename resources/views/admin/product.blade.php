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
            <form method="post" action="{{ url('/admin-dashboard/addproduct') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="pname">Product Name</label>
                            <input type="text" name="pname" id="pname" class="form-control" value="">
                            @error('pname')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="pslug">Slug</label>
                            <input type="text" name="pslug" id="pslug" class="form-control" value="">
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
                                        <option value="{{ $catg->id }}">{{ $catg->category_name }}</option>
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
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
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
                            @error('f_image')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="g_image">Gallery Images</label>
                            <input type="file" name="g_image[]" id="g_image" class="form-control" value="" multiple>
                            @error('g_image')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control" value="">
                            @error('price')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
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
                        </div>
                    </div>
                </div>
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
       
    
</script>
@endsection