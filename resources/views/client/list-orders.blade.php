@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-2 justify-content-center">
                <div class="card">
                    <div class="card-header">
                        Your reservations
                    </div>
                    <div class="card-body">
                        @if (!isset($orders[0]))
                            <div class="alert alert-warning text-center" role="alert">
                                You don't have any reservation yet
                            </div>
                        @endif
                        @foreach ($orders as $order)
                            <article class="itemlist">
                                <div class="row">
                                    <aside class="col-lg-3">
                                        <div class="img-wrap"><img
                                                    src="{{ isset($order->sellable->image) ? $order->sellable->image : asset('images/default_sellable_image.jpg') }}"
                                                    class="img-fluid"></div>
                                    </aside> <!-- col.// -->
                                    <div class="col-lg-5 pt-2 pt-lg-0">
                                        <div class="text-wrap">
                                            <h4 class="title"> {{$order->sellable->name}} </h4>
                                            <p> {{$order->sellable->description}} </p>
                                        </div>
                                    </div>
                                    <div class="col-1 d-none d-lg-block border-right"></div>
                                    <aside class="col-lg-3">
                                        <div class="">
                                            <p class="price-wrap">
                                                <span class="btn btn-price w-100"> {{$order->price}} CHF</span>
                                            </p> <!-- info-price-detail // -->
                                            <p class="">
                                                <a href="{{route('client.order.details', $order->id)}}"
                                                   class="btn btn-dark w-100">Show details</a>
                                            </p>
                                            <p class="">
                                                @if(isset($order->cancelled_at))
                                                    <span class="btn btn-cancelled w-100">Cancelled</span>
                                                    <br>
                                                @else
                                                    <button data-toggle="modal" data-target="#confirm-cancel-modal"
                                                            class="btn btn-danger w-100"
                                                            data-name="{{$order->sellable->name}}"
                                                            data-id="{{$order->id}}">Cancel
                                                    </button>
                                                    <br>
                                                @endif
                                            </p>
                                            <!-- cancel confirmation -->

                                            <div class="modal fade" id="confirm-cancel-modal" tabindex="-1"
                                                 role="dialog" aria-labelledby="confirm-cancel-modal-label"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <a href="#" data-dismiss="modal" aria-hidden="true"
                                                               class="close">×</a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger" id="modal-text"></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Dismiss
                                                            </button>
                                                            <form method="POST"
                                                                  action="{{route('client.order.cancel')}}">
                                                                @csrf
                                                                <input type="hidden" class="input-id" name="id"/>
                                                                <button type="submit" class="btn btn-danger">Cancel
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- action-wrap.// -->
                                    </aside> <!-- col.// -->
                                </div> <!-- row.// -->
                            </article> <!-- itemlist.// -->
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection