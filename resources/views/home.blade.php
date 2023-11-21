@extends('layouts.main')

@section('title', 'CMS | Dashboard')

@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Dashboard</h3>
            <div class="nk-block-des text-soft">
                <p>Welcome to Radio Today CMS Dashboard</p>
            </div>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">

                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
</div><!-- .nk-block -->

<div class="col-xxl-4">
    <div class="row g-4">
        <div class="col-sm-3 col-xxl-12">
            <div class="nk-order-ovwg-data buy">
                <div class="amount">12,954.63 <small class="currenct currency-usd">USD</small></div>
                <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">USD</span></strong></div>
                <div class="title"><em class="icon ni ni-arrow-down-left"></em> Buy Orders</div>
            </div>
        </div>
        <div class="col-sm-3 col-xxl-12">
            <div class="nk-order-ovwg-data sell">
                <div class="amount">12,954.63 <small class="currenct currency-usd">USD</small></div>
                <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">USD</span></strong></div>
                <div class="title"><em class="icon ni ni-arrow-up-left"></em> Sell Orders</div>
            </div>
        </div>
        <div class="col-sm-3 col-xxl-12">
            <div class="nk-order-ovwg-data sell">
                <div class="amount">12,954.63 <small class="currenct currency-usd">USD</small></div>
                <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">USD</span></strong></div>
                <div class="title"><em class="icon ni ni-arrow-up-left"></em> Sell Orders</div>
            </div>
        </div>
        <div class="col-sm-3 col-xxl-12">
            <div class="nk-order-ovwg-data sell">
                <div class="amount">12,954.63 <small class="currenct currency-usd">USD</small></div>
                <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">USD</span></strong></div>
                <div class="title"><em class="icon ni ni-arrow-up-left"></em> Sell Orders</div>
            </div>
        </div>
    </div>
</div>

<div class="card-inner">
    <div class="card-title-group align-start mb-3">
        <div class="card-title">
            <h6 class="title">Orders Overview</h6>
            <p>In last 15 days buy and sells overview. <a href="#" class="link link-sm">Detailed Stats</a></p>
        </div>
        <div class="card-tools mt-n1 me-n1">
            <div class="drodown">
                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"></a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                    <ul class="link-list-opt no-bdr">
                        <li><a href="#" class="active"><span>15 Days</span></a></li>
                        <li><a href="#"><span>30 Days</span></a></li>
                        <li><a href="#"><span>3 Months</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
       <div class="row nk-order-ovwg">
            <div class="col-md-6">
                <div class="nk-order-ovwg-ck">
                    <canvas class="order-overview-chart" id="orderOverview"></canvas>
                </div>
            </div>

            <div class="col-md-6">
                <div class="nk-order-ovwg-ck">
                    <canvas class="order-overview-chart" id="orderOverview1"></canvas>
                </div>
            </div>
       </div>
   </div>
   </div>

<div class="row">
    <div class="col-md-6 card card-bordered card-full">
        <div class="card-inner">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title"><span class="me-2">Orders Activities</span> <a href="#" class="link d-none d-sm-inline">See History</a></h6>
                </div>
                <div class="card-tools">
                    <ul class="card-tools-nav">
                        <li><a href="#"><span>Buy</span></a></li>
                        <li><a href="#"><span>Sell</span></a></li>
                        <li class="active"><a href="#"><span>All</span></a></li>
                    </ul>
                </div>
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner p-0 border-top">
            <div class="nk-tb-list nk-tb-orders">
                <div class="nk-tb-item nk-tb-head">
                    <div class="nk-tb-col nk-tb-orders-type"><span>Type</span></div>
                    <div class="nk-tb-col"><span>Desc</span></div>
                    <div class="nk-tb-col tb-col-sm"><span>Date</span></div>
                    <div class="nk-tb-col tb-col-xl"><span>Time</span></div>
                    <div class="nk-tb-col tb-col-xxl"><span>Ref</span></div>
                    <div class="nk-tb-col tb-col-sm text-end"><span>USD Amount</span></div>
                    <div class="nk-tb-col text-end"><span>Amount</span></div>
                </div><!-- .nk-tb-item -->
                <div class="nk-tb-item">
                    <div class="nk-tb-col nk-tb-orders-type">
                        <ul class="icon-overlap">
                            <li><em class="bg-btc-dim icon-circle icon ni ni-sign-btc"></em></li>
                            <li><em class="bg-success-dim icon-circle icon ni ni-arrow-down-left"></em></li>
                        </ul>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-lead">Buy Bitcoin</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm">
                        <span class="tb-sub">02/10/2020</span>
                    </div>
                    <div class="nk-tb-col tb-col-xl">
                        <span class="tb-sub">11:37 PM</span>
                    </div>
                    <div class="nk-tb-col tb-col-xxl">
                        <span class="tb-sub text-primary">RE2309232</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm text-end">
                        <span class="tb-sub tb-amount">4,565.75 <span>USD</span></span>
                    </div>
                    <div class="nk-tb-col text-end">
                        <span class="tb-sub tb-amount ">+ 0.2040 <span>BTC</span></span>
                    </div>
                </div><!-- .nk-tb-item -->
                <div class="nk-tb-item">
                    <div class="nk-tb-col nk-tb-orders-type">
                        <ul class="icon-overlap">
                            <li><em class="bg-eth-dim icon-circle icon ni ni-sign-eth"></em></li>
                            <li><em class="bg-success-dim icon-circle icon ni ni-arrow-down-left"></em></li>
                        </ul>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-lead">Buy Ethereum</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm">
                        <span class="tb-sub">02/10/2020</span>
                    </div>
                    <div class="nk-tb-col tb-col-xl">
                        <span class="tb-sub">10:37 PM</span>
                    </div>
                    <div class="nk-tb-col tb-col-xxl">
                        <span class="tb-sub text-primary">RE2309232</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm text-end">
                        <span class="tb-sub tb-amount">2,039.39 <span>USD</span></span>
                    </div>
                    <div class="nk-tb-col text-end">
                        <span class="tb-sub tb-amount ">+ 0.12600 <span>BTC</span></span>
                    </div>
                </div><!-- .nk-tb-item -->
                <div class="nk-tb-item">
                    <div class="nk-tb-col nk-tb-orders-type">
                        <ul class="icon-overlap">
                            <li><em class="bg-btc-dim icon-circle icon ni ni-sign-btc"></em></li>
                            <li><em class="bg-purple-dim icon-circle icon ni ni-arrow-up-right"></em></li>
                        </ul>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-lead">Sell Bitcoin</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm">
                        <span class="tb-sub">02/10/2020</span>
                    </div>
                    <div class="nk-tb-col tb-col-xl">
                        <span class="tb-sub">10:45 PM</span>
                    </div>
                    <div class="nk-tb-col tb-col-xxl">
                        <span class="tb-sub text-primary">RE2309232</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm text-end">
                        <span class="tb-sub tb-amount">9,285.71 <span>USD</span></span>
                    </div>
                    <div class="nk-tb-col text-end">
                        <span class="tb-sub tb-amount ">+ 0.94750 <span>BTC</span></span>
                    </div>
                </div><!-- .nk-tb-item -->
                <div class="nk-tb-item">
                    <div class="nk-tb-col nk-tb-orders-type">
                        <ul class="icon-overlap">
                            <li><em class="bg-eth-dim icon-circle icon ni ni-sign-eth"></em></li>
                            <li><em class="bg-purple-dim icon-circle icon ni ni-arrow-up-right"></em></li>
                        </ul>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-lead">Sell Etherum</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm">
                        <span class="tb-sub">02/11/2020</span>
                    </div>
                    <div class="nk-tb-col tb-col-xl">
                        <span class="tb-sub">10:25 PM</span>
                    </div>
                    <div class="nk-tb-col tb-col-xxl">
                        <span class="tb-sub text-primary">RE2309232</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm text-end">
                        <span class="tb-sub tb-amount">12,596.75 <span>USD</span></span>
                    </div>
                    <div class="nk-tb-col text-end">
                        <span class="tb-sub tb-amount ">+ 1.02050 <span>BTC</span></span>
                    </div>
                </div><!-- .nk-tb-item -->
                <div class="nk-tb-item">
                    <div class="nk-tb-col nk-tb-orders-type">
                        <ul class="icon-overlap">
                            <li><em class="bg-btc-dim icon-circle icon ni ni-sign-btc"></em></li>
                            <li><em class="bg-success-dim icon-circle icon ni ni-arrow-down-left"></em></li>
                        </ul>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-lead">Buy Bitcoin</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm">
                        <span class="tb-sub">02/10/2020</span>
                    </div>
                    <div class="nk-tb-col tb-col-xl">
                        <span class="tb-sub">10:12 PM</span>
                    </div>
                    <div class="nk-tb-col tb-col-xxl">
                        <span class="tb-sub text-primary">RE2309232</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm text-end">
                        <span class="tb-sub tb-amount">400.00 <span>USD</span></span>
                    </div>
                    <div class="nk-tb-col text-end">
                        <span class="tb-sub tb-amount ">+ 0.00056 <span>BTC</span></span>
                    </div>
                </div><!-- .nk-tb-item -->
                <div class="nk-tb-item">
                    <div class="nk-tb-col nk-tb-orders-type">
                        <ul class="icon-overlap">
                            <li><em class="bg-eth-dim icon-circle icon ni ni-sign-eth"></em></li>
                            <li><em class="bg-purple-dim icon-circle icon ni ni-arrow-up-right"></em></li>
                        </ul>
                    </div>
                    <div class="nk-tb-col">
                        <span class="tb-lead">Sell Etherum</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm">
                        <span class="tb-sub">02/09/2020</span>
                    </div>
                    <div class="nk-tb-col tb-col-xl">
                        <span class="tb-sub">05:15 PM</span>
                    </div>
                    <div class="nk-tb-col tb-col-xxl">
                        <span class="tb-sub text-primary">RE2309232</span>
                    </div>
                    <div class="nk-tb-col tb-col-sm text-end">
                        <span class="tb-sub tb-amount">6,246.50 <span>USD</span></span>
                    </div>
                    <div class="nk-tb-col text-end">
                        <span class="tb-sub tb-amount ">+ 0.02575 <span>BTC</span></span>
                    </div>
                </div><!-- .nk-tb-item -->
            </div>
        </div><!-- .card-inner -->

        <div class="card-inner-sm border-top text-center d-sm-none">
            <a href="#" class="btn btn-link btn-block">See History</a>
        </div><!-- .card-inner -->
    </div>

    <div class="col-md-6 col-xxl-3">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title card-title-sm">
                        <h6 class="title">Traffic Channel</h6>
                    </div>
                    <div class="card-tools">
                        <div class="drodown">
                            <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-opt no-bdr">
                                    <li><a href="#"><span>7 Days</span></a></li>
                                    <li><a href="#"><span>15 Days</span></a></li>
                                    <li><a href="#"><span>30 Days</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="traffic-channel">
                    <div class="traffic-channel-doughnut-ck"><canvas class="analytics-doughnut" id="TrafficChannelDoughnutData" width="591" height="240" style="display: block; box-sizing: border-box; height: 160px; width: 394px;"></canvas></div>
                    <div class="traffic-channel-group g-2">
                        <div class="traffic-channel-data">
                            <div class="title"><span class="dot dot-lg sq" data-bg="#9cabff"></span><span>Organic Search</span></div>
                            <div class="amount">4,305 <small>58.63%</small></div>
                        </div>
                        <div class="traffic-channel-data">
                            <div class="title"><span class="dot dot-lg sq" data-bg="#b8acff"></span><span>Social Media</span></div>
                            <div class="amount">859 <small>23.94%</small></div>
                        </div>
                        <div class="traffic-channel-data">
                            <div class="title"><span class="dot dot-lg sq" data-bg="#ffa9ce"></span><span>Referrals</span></div>
                            <div class="amount">482 <small>12.94%</small></div>
                        </div>
                        <div class="traffic-channel-data">
                            <div class="title"><span class="dot dot-lg sq" data-bg="#f9db7b"></span><span>Others</span></div>
                            <div class="amount">138 <small>4.49%</small></div>
                        </div>
                    </div><!-- .traffic-channel-group -->
                </div><!-- .traffic-channel -->
            </div>
        </div><!-- .card -->
    </div>

</div>

@endsection
@push('scripts')
<script>

var barChart = @json($barChart);
    console.log();

var orderOverview1 = {
    labels: barChart['labels'],
    dataUnit: 'USD',
    datasets: [{
      label: "Sell Orders",
      color: "#9cabff",
      data: barChart['data']
    }]
  };

var barChart1 = @json($barChart1);
    console.log();

var orderOverview = {
    labels: barChart1['labels'],
    dataUnit: 'USD',
    datasets: [{
      label: "Sell Orders",
      color: "#9cabff",
      data: barChart1['data']
    }]
  };


</script>
@endpush
