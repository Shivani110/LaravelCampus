@extends('publicdashboard_layout.master')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Cart Items</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col tb-col-sm"><span>Product</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Price</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Quantity</span></div>
                                        <div class="nk-tb-col tb-col-sm">Amount</div>
                                    </div><!-- .nk-tb-item -->
                                    <?php $amount = ''; ?> 
                                    @foreach($cart as $data)
                                        <?php
                                            $price = '';
                                            $quantity = $data->quantity;
                                        ?>
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-product">
                                                    <?php 
                                                        $pid = $data->product_id;
                                                        $product = (App\Models\Product::where('id','=',$pid))->first();
                                                    ?>
                                                    <img src="{{ asset('/images/'.$product->feature_images) }}" alt="" class="thumb">
                                                    <span class="title">{{ $product->product_name }}</span>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span>
                                                    <?php
                                                        $vid = $data->variation_id;
                                                        $variation = (App\Models\Variation::where('id','=',$vid))->first();
                                                        $price = $variation->price;
                                                    ?>
                                                    ${{ number_format($price,2) }}
                                                </span>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <ul class="d-flex flex-wrap ailgn-center g-2 pt-1">
                                                    <li class="w-140px">
                                                        <div class="form-control-wrap number-spinner-wrap">
                                                            <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus" data-id="{{ $data->id }}"><em class="icon ni ni-minus"></em></button>
                                                            <input type="number" class="form-control number-spinner" value="{{ $quantity }}" name="qty" id="qty{{ $data->id }}" min="1">
                                                            <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus" data-id="{{ $data->id }}"><em class="icon ni ni-plus"></em></button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm amt{{ $data->id }}">
                                                <span class="tb-lead">
                                                    <?php 
                                                        $total = $price * $quantity;
                                                        $amount = (int)$amount;
                                                        $amount += $total;
                                                    
                                                    ?>
                                                    ${{ number_format($total,2) }}
                                                </span>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                    @endforeach
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col tb-col-2">
                                        </div>
                                        <div class="nk-tb-col tb-col-2">
                                        </div>
                                        <div class="nk-tb-col tb-col-1">
                                            <span class="tb-lead">Subtotal</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-2 sub">
                                            <?php 
                                                $subtotal = $amount;
                                            ?>
                                            <span class="tb-lead">${{ number_format($subtotal,2) }}</span>
                                        </div>
                                        
                                    </div>
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col tb-col-2">
                                        </div>
                                        <div class="nk-tb-col tb-col-2">
                                        </div>
                                        <div class="nk-tb-col tb-col-1">
                                        </div>
                                        <div class="nk-tb-col tb-col-2">
                                            <ul class="d-flex flex-wrap ailgn-center g-2 pt-1">
                                                <li class="w-140px">
                                                    <a href="{{ url('checkout') }}" class="btn btn-dark">Buy Now</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

<script>
    $('.number-minus').click(function(){
        id = $(this).attr('data-id');
        qty = $('#qty'+id).val();
        quantity = qty-1;

        if(quantity>=1){
            var data = {
                id:id,
                quantity:quantity,
                _token:"{{ csrf_token() }}"
            }
            $.ajax({
                url: "{{ url('decreasequantity') }}",
                type: "POST",
                data: data,
                dataType: "JSON",
                success: function(response){
                   if(response){
                        id = data.id;
                        cart = response[0];
                        total = response[1];
                        subtotal = response[2];
                        amount = new Intl.NumberFormat().format(total);
                        famount = '$'+amount+'.00';
                        s_total = new Intl.NumberFormat().format(subtotal);
                        stotal = '$'+s_total+'.00';

                        var html = '<span class="tb-lead">'+famount+'</span>';
                        $('.amt'+id).html(html);

                        var html2 = '<span class="tb-lead">'+stotal+'</span>';
                        $('.sub').html(html2);

                        NioApp.Toast("Quantity decreased","info",{position:'top-right'});
                   }
                }
            });
        }
    });

    $('.number-plus').click(function(){
        id = $(this).attr('data-id');
        qty = $('#qty'+id).val();
        quantity = parseInt(qty)+1;

        if(quantity>1){
            var data = {
                id: id,
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            }
            $.ajax({
                url: "{{ url('increasequantity') }}",
                type: "POST",
                data: data,
                dataType: "JSON",
                success: function(response){
                    if(response){
                        id = data.id;
                        cart = response[0];
                        total = response[1];
                        subtotal = response[2];
                        amount = new Intl.NumberFormat().format(total);
                        famount = '$'+amount+'.00';
                        s_total = new Intl.NumberFormat().format(subtotal);
                        stotal = '$'+s_total+'.00';

                        var html = '<span class="tb-lead">'+famount+'</span>';
                        $('.amt'+id).html(html);

                        var html2 = '<span class="tb-lead">'+stotal+'</span>';
                        $('.sub').html(html2);

                        NioApp.Toast("Quantity increases","info",{position:'top-right'});
                    }
                }
            });
        }
    });

</script>
               
@endsection