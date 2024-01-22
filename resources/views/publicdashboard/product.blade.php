@extends('publicdashboard_layout.master')
 
 @section('content')

    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Product Details</h3>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs"> 
                            @foreach($product as $data)
                            <div class="col-sm-6 col-lg-4 col-xxl-3">
                                <div class="gallery card card-bordered">
                                    <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                        <div class="user-card">
                                            <img src="{{ asset('/images/'.$data->feature_images)}}" alt="img">
                                            
                                            <div>
                                                <a href="{{ url('productdetails/'.$data->slug) }}" class="btn btn-p-0 btn-nofocus">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
