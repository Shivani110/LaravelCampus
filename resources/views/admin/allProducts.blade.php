@extends('admin_layout.master')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Products</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col tb-col-sm"><span>Name</span></div>
                                        <div class="nk-tb-col"><span>Tags</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Category</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                Action
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach($product as $pd)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <img src="{{ asset('/images/'.$pd->feature_images) }}" alt="" class="thumb">
                                                <span class="title">{{ $pd->product_name }}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">
                                                <?php
                                                    if($pd->tags ?? ''){
                                                        $tag = json_decode($pd->tags); ?>
                                                        <ul>
                                                <?php   foreach($tag as $tid){
                                                            $tags = (App\Models\Tag::where('id','=',$tid)->first()); ?>

                                                            <li>{{ $tags->name }}</li>
                                                <?php   }   ?>
                                                        </ul>
                                            <?php   }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-lead">{{ $category->category_name }}</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{ url('/admin-dashboard/product/'.$pd->slug) }}"><em class="icon ni ni-edit"></em><span>Edit Product</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Product</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @endforeach
                                </div><!-- .nk-tb-list -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
            
@endsection