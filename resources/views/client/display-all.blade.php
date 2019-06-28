@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Filters</div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-md-10 justify-content-center">
                <div class="card">
                    <div class="card-header">Last offers</div>
                    <div class="card-body">

                        @foreach($sellables as $sellable)

                            <article class="itemlist">
                                <div class="row row-sm">
                                    <aside class="col-sm-3">
                                        <div class="img-wrap"><img src="{{ isset($sellable->image) ? $sellable->image : asset('images/default_sellable_image.jpg') }}" class="img-fluid" ></div>
                                    </aside> <!-- col.// -->
                                    <div class="col-sm-6">
                                        <div class="text-wrap">
                                            <h4 class="title"> {{$sellable->name}} </h4>
                                            <p> {{$sellable->description}} </p>
                                            <!--<p class="rating-wrap my-0 text-muted">
                                                <span class="label-rating">132 reviews</span>
                                                <span class="label-rating">154 orders </span>-->
                                            </p> <!-- rating-wrap.// -->
                                        </div> <!-- text-wrap.// -->
                                    </div> <!-- col.// -->
                                    <aside class="col-sm-3">
                                        <div class="border-left pl-3">
                                            <div class="price-wrap">
                                                <span class="h3 price text-info"> {{$sellable->price}} CHF</span>
                                            </div> <!-- info-price-detail // -->
                                            <p>
                                                <a href="{{route('client.sellable.details', $sellable->id)}}" class="btn btn-dark"> Details  </a> </p>
                                        </div> <!-- action-wrap.// -->
                                    </aside> <!-- col.// -->
                                </div> <!-- row.// -->
                            </article> <!-- itemlist.// -->
                            <hr>

                        @endforeach

                        <a>See more... </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
