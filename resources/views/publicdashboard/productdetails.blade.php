@extends('publicdashboard_layout.master')
 
@section('content')

<div class="nk-content ">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Product Details</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="html/product-list.html" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                            <a href="html/product-list.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    @foreach($products as $data)
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="row pb-5">
                                <div class="col-lg-6">
                                    <div class="product-gallery me-xl-1 me-xxl-5">
                                        <div class="slider-init" id="sliderFor" data-slick='{"arrows": false, "fade": true, "asNavFor":"#sliderNav", "slidesToShow": 1, "slidesToScroll": 1}'>
                                            @foreach($data->media as $media)
                                                <div class="slider-item rounded">
                                                    <img src="{{ asset('/images/'.$media->image_name) }}" class="w-80" alt="">
                                                </div>
                                            @endforeach
                                        </div><!-- .slider-init -->
                                        <div class="slider-init slider-nav" id="sliderNav" data-slick='{"arrows": false, "slidesToShow": 5, "slidesToScroll": 1, "asNavFor":"#sliderFor", "centerMode":true, "focusOnSelect": true, "responsive":[ {"breakpoint": 1539,"settings":{"slidesToShow": 4}}, {"breakpoint": 768,"settings":{"slidesToShow": 3}}, {"breakpoint": 420,"settings":{"slidesToShow": 2}} ]}'>
                                            @foreach($data->media as $media)
                                                <div class="slider-item">
                                                    <div class="thumb">
                                                        <img src="{{ asset('/images/'.$media->image_name) }}" alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div><!-- .slider-nav -->
                                    </div><!-- .product-gallery -->
                                </div><!-- .col -->
                                <div class="col-lg-6">
                                    <div class="product-info mt-5 me-xxl-5">
                                        <h4 class="product-price text-primary">${{ number_format($data->price,2) }}</h4>
                                        <h2 class="product-title">{{ $data->product_name }}</h2>
                                        <div class="product-excrept text-soft">
                                            <p class="lead">{{ $data->description }}</p>
                                        </div>
                                        <div class="product-meta">
                                            <h6 class="title">Variation</h6>
                                            <ul class="custom-control-group">
                                                @foreach($data->variation as $variation)
                                                <li>
                                                    <div class="custom-control custom-radio custom-control-pro no-control">
                                                        <input type="radio" class="custom-control-input variation" name="sizeCheck" id="sizeCheck{{ $variation->id }}" value="{{ $variation->price }}">
                                                        <label class="custom-control-label" for="sizeCheck{{ $variation->id }}">${{ number_format($variation->price,2) }}</label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div><!-- .product-meta -->
                                        <div class="product-meta">
                                            <ul class="d-flex flex-wrap ailgn-center g-2 pt-1">
                                                <li class="w-140px">
                                                    <div class="form-control-wrap number-spinner-wrap">
                                                        <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus"><em class="icon ni ni-minus"></em></button>
                                                        <input type="number" class="form-control number-spinner" value="0">
                                                        <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus"><em class="icon ni ni-plus"></em></button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <button class="btn btn-primary">Add to Cart</button>
                                                </li>
                                            </ul>
                                        </div><!-- .product-meta -->
                                    </div><!-- .product-info -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div>
                    </div>
                    @endforeach
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

<script>
    $('.variation').change(function(){
        v_price = $(this).val();
        price = new Intl.NumberFormat().format(v_price);
        formattedprice = '$'+price+'.00';
        $('.product-price').html('<span>'+formattedprice+'</span>');
    });
</script>

@endsection