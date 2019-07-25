@extends('layouts.admin')

@section('content')

    @if (!isset($orders[0]))
        <div class="alert alert-warning text-center" role="alert">
            You don't have any reservation for your sellables yet. You can create one <a href="#" data-toggle="modal" data-target="#select-sellable-modal">here</a>.
        </div>
    @endif

    <br>
    <article class="itemlist">
        <div class="row">
            <aside class="col-md-3">
            </aside>
            <div class="col-md-6">
                <div class="text-wrap">
                    <h2 class="title">Your reservations</h2>
                </div>
            </div>
            <div class="col-1 d-none d-md-block border-right"></div>
            <aside class="col-md-2">
                <div class="">
                    <p class="">
                        <a href="#" data-toggle="modal" data-target="#select-sellable-modal" class="btn btn-dark w-100">Pass a reservation</a>
                    </p>
                </div>
            </aside>
        </div>
    </article>

    <div class="modal fade" id="select-sellable-modal" tabindex="-1" role="dialog" aria-labelledby="select-sellable-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label for="sellable">Select your sellable</label>
                    <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                </div>
                <form method="POST" action="{{route('provider.order.add')}}" class="col-6 offset-3">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" id="sellable" name="sellable">
                                @foreach($sellables as $sellable)
                                    <option value="{{$sellable->id}}">{{$sellable->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark">Select</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr>

    @foreach ($orders as $order)
        <article class="itemlist">
            <div class="row">
                <aside class="col-md-3">
                    <div class="img-wrap"><img src="{{ isset($order->sellable->image) ? $order->sellable->image : asset('images/default_sellable_image.jpg') }}" class="img-fluid" ></div>
                </aside> <!-- col.// -->
                <div class="col-md-6 pt-2 pt-md-0">
                    <div class="text-wrap">
                        <h4 class="title"> {{$order->sellable->name}} </h4>
                        <p> {{$order->client->name}} </p>
                    </div>
                </div>
                <div class="col-1 d-none d-md-block border-right"></div>
                <aside class="col-md-2">
                    <div class="">
                        <p class="price-wrap">
                            <span class="btn btn-price w-100"> {{$order->price}} CHF</span>
                        </p> <!-- info-price-detail // -->
                        <p class="">
                            <a href="{{route('provider.order.detail', $order->id)}}" class="btn btn-dark w-100">Show details</a>
                        </p>
                        @if(!isset($order->cancelled_at))
                        <p class="">
                            <a href="{{route('provider.order.manage', $order->id)}}" class="btn btn-dark w-100">Manage for client</a>
                        </p>
                        @endif
                        <p class="">
                            @if(isset($order->cancelled_at))
                                <span class="btn btn-cancelled w-100">Cancelled</span>
                                <br>
                            @else
                                <button data-toggle="modal" data-target="#confirm-cancel-modal" class="btn btn-danger w-100" data-name="{{$order->client->name}}" data-id="{{$order->id}}">Cancel</button>
                                <br>
                            @endif
                        </p>
                        <p class="">
                            <button data-toggle="modal" data-target="#confirm-delete-modal" class="btn btn-danger w-100" data-name="{{$order->client->name}}" data-id="{{$order->id}}">Delete</button>
                            <br>
                        </p>
                        <!-- delete confirmation -->

                        <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" id="modal-text-delete"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                                        <form method="POST" action="{{route('provider.order.delete')}}">
                                            @csrf
                                            <input type="hidden" class="input-id" name="id"/>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="confirm-cancel-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-cancel-modal-label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" id="modal-text-cancel"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                                        <form method="POST" action="{{route('provider.order.cancel')}}">
                                            @csrf
                                            <input type="hidden" class="input-id" name="id"/>
                                            <button type="submit" class="btn btn-danger">Cancel</button>
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


@endsection


