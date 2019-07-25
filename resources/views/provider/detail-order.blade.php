@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="card">
            @isset($order)
            <div class="row p-5">
                <aside class="col-md-3">
                    <a href="#" data-fancybox=""><img class="img-fluid" src="{{ isset($order->sellable->image) ? $order->sellable->image : asset('images/default_sellable_image.jpg') }}"></a>
                </aside>
                <div class="col-md-5 pt-2 pt-md-0">
                    <div class="row">
                        <h3 class="col title mb-3">{{$order->sellable->name}}</h3>
                    </div>
                    <div class="row">
                        <p class="col">{{$order->sellable->description}}</p>
                    </div>
                </div> <!-- col.// -->
                <div class="col-1 border-right d-none d-md-block"></div>
                <div class="col-md-3">
                    <var class="price h3 text-info">
                        @if(isset($order->cancelled_at))
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger">
                                        <div class="num">Cancelled !</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <del class="col"><span class="num">{{$order->price}} </span><span class="currency">CHF</span></del>
                            </div>
                        @else
                            <span class="num">{{$order->price}} </span><span class="currency">CHF</span>
                        @endif
                    </var>
                </div>
            </div> <!-- row.// -->
            <hr>
            <div class="row p-5">
                <div class="col-md-9 offset-md-3">
                    <div class="row pb-2 p-md-2">
                        <div class="col-sm-3 font-weight-bold">Client</div>
                        <div class="col-sm-1 border-right d-none d-sm-block"></div>
                        <div class="col-sm-8">{{$order->client->name}}</div>
                    </div>
                    <div class="row pb-2 p-md-2">
                        <div class="col-sm-3 font-weight-bold">E-mail</div>
                        <div class="col-sm-1 border-right d-none d-sm-block"></div>
                        <div class="col-sm-8">{{$order->client->email}}</div>
                    </div>
                    <div class="row pb-2 p-md-2">
                        <div class="col-sm-3 font-weight-bold">Address</div>
                        <div class="col-sm-1 border-right d-none d-sm-block"></div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col">
                                {{$order->client->street}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    {{$order->client->npa}} {{$order->client->town}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    {{$order->client->country}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($order->fields as $field)
                        <div class="row pb-2 p-md-2">
                            <div class="col-sm-3 font-weight-bold">
                                {{$field->name}}
                            </div>
                            <div class="col-sm-1 border-right d-none d-sm-block"></div>
                            <div class="col-sm-8">
                                {{$field->value}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if(!isset($order->cancelled_at))
                <div class="card-footer">
                    <div class="row ">
                        <div class="col text-center">
                            <a href="{{route('provider.order.manage', $order->id)}}" class="btn btn-dark btn-manage-p w-auto">Manage for client</a>
                        </div>
                    </div>
                </div>
            @endif
            @endisset
        </div> <!-- card.// -->
    </div>

@endsection