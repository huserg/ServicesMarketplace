@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-2 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-header">Filters</div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-lg-10 justify-content-center">
                <div class="card">
                    <div class="card-header">Last offers</div>
                    <div class="card-body">

                        @foreach($sellables as $sellable)

                            <article class="itemlist">
                                <div class="row">
                                    <aside class="col-lg-3">
                                        <div class="img-wrap"><img src="{{ isset($sellable->image) ? $sellable->image : asset('images/default_sellable_image.jpg') }}" class="img-fluid" ></div>
                                    </aside> <!-- col.// -->
                                    <div class="col-lg-5 pt-2 pt-lg-0">
                                        <div class="text-wrap">
                                            <h4 class="title"> {{$sellable->name}} </h4>
                                            <p> {{$sellable->description}} </p>
                                            <!--<p class="rating-wrap my-0 text-muted">
                                                <span class="label-rating">132 reviews</span>
                                                <span class="label-rating">154 orders </span>-->
                                            </p> <!-- rating-wrap.// -->
                                        </div> <!-- text-wrap.// -->
                                    </div> <!-- col.// -->
                                    <div class="col-1 d-none d-lg-block border-right"></div>
                                    <aside class="col-lg-3">
                                            <div class="price-wrap">
                                                <span class="h3 btn-price text-info"> {{$sellable->price}} CHF</span>
                                            </div> <!-- info-price-detail // -->
                                            <p>
                                                <a href="{{route('client.sellable.details', $sellable->id)}}" class="btn btn-dark"> Details  </a>
                                            </p>
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
