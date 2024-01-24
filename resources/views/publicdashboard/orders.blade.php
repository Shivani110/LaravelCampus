@extends('publicdashboard_layout.master')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="invoice">
                        <div class="invoice-wrap">
                            <div class="invoice-brand text-center">
                                <img src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="">
                            </div>
                            <div class="invoice-head">
                                <div class="invoice-contact">
                                    <span class="overline-title">Invoice To</span>
                                    <div class="invoice-contact-info">
                                        <h4 class="title">{{ Auth::user()->realname }}</h4>
                                        <ul class="list-plain">
                                            <li><em class="icon ni ni-map-pin-fill"></em><span>{{ $ordermeta[0]->order->street }}<br>{{ $ordermeta[0]->order->city }}, {{ $ordermeta[0]->order->state }} {{ $ordermeta[0]->order->zip }}</span></li>
                                            <li><em class="icon ni ni-call-fill"></em><span>+01{{ Auth::user()->phone }}</span></li>
                                            <li>
                                                @if($ordermeta[0]->order->status == '2')
                                                    <button class="btn btn-primary badge badge-dim bg-outline-warning" onclick="confirmOrder(id={{ $ordermeta[0]->order->id }},status={{ $ordermeta[0]->order->status }})">Confirmed</button>
                                                @elseif($ordermeta[0]->order->status == '3')
                                                    <button class="btn btn-primary badge badge-dim bg-outline-warning">Shipped</button>
                                                @elseif($ordermeta[0]->order->status == '4')
                                                    <button class="btn btn-primary badge badge-dim bg-outline-info">Delivered</button>
                                                @elseif($ordermeta[0]->order->status == '5')
                                                    <button class="btn btn-primary badge badge-dim bg-outline-success">Completed</button>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .invoice-head -->
                            <div class="invoice-bills">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="w-30">Image</th>
                                                <th class="w-150px">Order ID</th>
                                                <th class="w-30">Description</th>
                                                <th class="w-20">Price</th>
                                                <th class="w-20">Qty</th>
                                                <th class="w-20">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $amount=""; ?>
                                        @foreach($ordermeta as $data)   
                                            <tr>
                                                <?php
                                                    $pid = $data->product_id;
                                                    $product = (App\Models\Product::where('id','=',$pid)->first());
                                                ?>
                                                <td>
                                                    <img src="{{ asset('/images/'.$product->feature_images) }}">
                                                </td>
                                                <td>{{ $data->order->orderID }}</td>
                                                <td>
                                                   
                                                    {{ $product->description }}
                                                </td>
                                                <td>
                                                    <?php
                                                        $vid = $data->variation_id;
                                                        $variation = (App\Models\Variation::where('id','=',$vid)->first());
                                                        $price = $variation->price;
                                                    ?>
                                                    ${{ number_format($price,2) }}
                                                </td>
                                                <td>{{ $data->quantity }}</td>
                                                <td>
                                                    <?php
                                                        $quantity = $data->quantity;
                                                        $total = (int)$price*(int)$quantity;
                                                        $amount = (int)$amount;
                                                        $amount += $total;
                                                    ?>
                                                    ${{ number_format($total,2) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="1">Subtotal</td>
                                                <td>
                                                    <?php
                                                        $subtotal = $amount;
                                                    ?>
                                                    ${{ number_format($subtotal,2) }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div><!-- .invoice-bills -->
                        </div><!-- .invoice-wrap -->
                    </div><!-- .invoice -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

<script>

    function confirmOrder(id,status){
        var data={
            id: id,
            status: status,
        }
        $.ajax({
            url: "",
            type:"POST",
            data:data,
            dataType:"JSON",
            success: function(response){
                console.log(response);
            }
        });

    }

</script>

@endsection