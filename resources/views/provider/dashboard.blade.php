@extends('layouts.admin')

@section('content')

        <div class="row">
                @isset ($sellable)
                <div class="col-lg-4 col-md-6">
                        <div class="card dashboard-card">
                                <a class="card-link" href="{{ route('provider.sellable.manage', $sellable->id) }}">
                                        <div class="card-header">Last offer - {{$sellable->name}}</div>
                                </a>
                                <div class="card-body">
                                        <div class="row">
                                                <div class="col-9">
                                                        <div class="text-wrap">
                                                                <p> {{$sellable->description}} </p>
                                                                <!--<p class="rating-wrap my-0 text-muted">
                                                                    <span class="label-rating">132 reviews</span>
                                                                    <span class="label-rating">154 orders </span>-->
                                                                </p> <!-- rating-wrap.// -->
                                                        </div> <!-- text-wrap.// -->
                                                </div> <!-- col.// -->
                                                <div class="col-3 border-left">
                                                        <p> {{ $sellable->price }} CHF</p>
                                                </div>
                                        </div> <!-- row.// -->
                                </div>
                        </div>
                </div>
                @endisset

                @isset ($order)
                <div class="col-lg-4 col-md-6">
                        <div class="card dashboard-card">
                                <a class="card-link" href="{{ route('provider.order.detail', $order->id) }}">
                                        <div class="card-header">Last reservation - {{$order->sellable->name}}</div>
                                </a>
                                <div class="card-body">
                                        <div class="row">
                                                <div class="col-9">
                                                        <div class="text-wrap">
                                                                <p> {{$order->client->name}} </p>
                                                                <!--<p class="rating-wrap my-0 text-muted">
                                                                    <span class="label-rating">132 reviews</span>
                                                                    <span class="label-rating">154 orders </span>-->
                                                                </p> <!-- rating-wrap.// -->
                                                        </div> <!-- text-wrap.// -->
                                                </div> <!-- col.// -->
                                                <div class="col-3 border-left">
                                                        <p> {{ $order->price }} </p>
                                                </div>
                                        </div> <!-- row.// -->
                                </div>
                        </div>
                </div>
                @endisset

                <div class="col-lg-4 col-md-6 dashboard-card">
                        <div class="card">
                                <div class="card-header">Sell Statistics</div>
                                <div class="card-body">

                                </div>
                        </div>
                </div>

                <div class="col-lg-4 col-md-6 dashboard-card">
                        <div class="card">
                                <div class="card-header">Next booking</div>
                                <div class="card-body">

                                </div>
                        </div>
                </div>

                <div class="col-lg-4 col-md-6 dashboard-card">
                        <div class="card">
                                <div class="card-header">...</div>
                                <div class="card-body">

                                </div>
                        </div>
                </div>

                <div class="col-lg-4 col-md-6 dashboard-card">
                        <div class="card">
                                <div class="card-header">...</div>
                                <div class="card-body">

                                </div>
                        </div>
                </div>

                <div class="col-lg-4 col-md-6 dashboard-card">
                        <div class="card">
                                <div class="card-header">...</div>
                                <div class="card-body">

                                </div>
                        </div>
                </div>

                <div class="col-lg-4 col-md-6 dashboard-card">
                        <div class="card">
                                <div class="card-header">...</div>
                                <div class="card-body">

                                </div>
                        </div>
                </div>

                <div class="col-lg-4 col-md-6 dashboard-card">
                        <div class="card">
                                <div class="card-header">...</div>
                                <div class="card-body">

                                </div>
                        </div>
                </div>

        </div>


@endsection


