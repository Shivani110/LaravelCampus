@extends('publicdashboard_layout.master')

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h5 class="title">All Invoice</h5>
                                    </div>
                                </div><!-- .card-title-group -->
                            </div><!-- .card-inner -->
                            <div class="card-inner p-0">
                                <table class="table table-orders">
                                    <thead class="tb-odr-head">
                                        <tr class="tb-odr-item">
                                            <th class="tb-odr-info">
                                                <span class="tb-odr-id">Order ID</span>
                                                <span class="tb-odr-date d-none d-md-inline-block">Date</span>
                                            </th>
                                            <th class="tb-odr-amount">
                                                <span class="tb-odr-total">Amount</span>
                                                <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                                            </th>
                                            <th class="tb-odr-action">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tb-odr-body">
                                        <tr class="tb-odr-item">
                                            <td class="tb-odr-info">
                                                <span class="tb-odr-id">{{ $ordermeta->order->orderID }}</span>
                                                <span class="tb-odr-date">{{ $ordermeta->order->created_at->format('d/m/Y') }}, {{ $ordermeta->order->created_at->format('H:m:s') }}</span>
                                            </td>
                                            <td class="tb-odr-amount">
                                                <span class="tb-odr-total">
                                                    <span class="amount">
                                                        <?php
                                                            $price = $ordermeta->order->amount;
                                                        ?>
                                                        ${{ number_format($price,2) }}
                                                    </span>
                                                </span>
                                                <span class="tb-odr-status">
                                                <?php $status = $ordermeta->order->status; ?>
                                                    @if($status == "2")
                                                        <span class="badge badge-dot bg-warning">Confirmed</span> 
                                                    @elseif($status == "3")
                                                        <span class="badge badge-dot bg-warning">Shipped</span>
                                                    @elseif($status == "4")
                                                        <span class="badge badge-dot bg-info">Delivered</span>
                                                    @elseif($status == "5")
                                                        <span class="badge badge-dot bg-success">Completed</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="tb-odr-action">
                                                <div class="tb-odr-btns d-none d-sm-inline">
                                                    <a href="{{ url('orders') }}" class="btn btn-dim btn-sm btn-primary">View</a>
                                                </div>
                                                <a href="html/invoice-details.html" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                            </td>
                                        </tr><!-- .tb-odr-item -->
                                    </tbody>
                                </table>
                            </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

@endsection