@extends('layouts.admin')

@section('content')

    @if (!isset($sellables[0]))
        <div class="alert alert-warning text-center" role="alert">
            You don't have any sellables yet. You can create one <a href="{{route('provider.sellable.add')}}">here</a>.
        </div>
    @endif

    <br>
    <article class="itemlist">
        <div class="row">
            <aside class="col-md-3">
            </aside>
            <div class="col-md-6">
                <div class="text-wrap">
                    <h2 class="title">Your sellables</h2>
                </div>
            </div>
            <div class="col-1 d-none d-md-block border-right"></div>
            <aside class="col-md-2">
                <div class="">
                    <p class="">
                        <a href="{{route('provider.sellable.add')}}"  class="btn btn-dark w-100">Add a new sellable</a>
                    </p>
                </div>
            </aside>
        </div>
    </article>

    <hr>

    @foreach ($sellables as $sellable)
        <article class="itemlist">
            <div class="row">
                <aside class="col-md-3">
                    <div class="img-wrap"><img src="{{ isset($sellable->image) ? $sellable->image : asset('images/default_sellable_image.jpg') }}" class="img-fluid" ></div>
                </aside> <!-- col.// -->
                <div class="col-md-6 pt-2 pt-md-0">
                    <div class="text-wrap">
                        <h4 class="title"> {{$sellable->name}} </h4>
                        <p> {{$sellable->description}} </p>
                    </div>
                </div>
                <div class="col-1 d-none d-md-block border-right"></div>
                <aside class="col-md-2">
                    <div class="">
                        <p class="price-wrap">
                            <span class="btn btn-price w-100"> {{$sellable->price}} CHF</span>
                        </p> <!-- info-price-detail // -->
                        <p class="">
                            <a href="{{route('provider.sellable.manage', $sellable->id)}}" class="btn btn-dark w-100">Manage</a>
                        </p>
                        <form method="POST" action="{{route('provider.order.add')}}">
                            @csrf
                            <input type="hidden" value="{{$sellable->id}}" name="sellable">
                            <p class="">
                                <button type="submit" class="btn btn-dark w-100">Order for client</button>
                            </p>
                        </form>
                        <p class="">
                            <button data-toggle="modal" data-target="#confirm-delete-modal" class="btn btn-danger w-100" data-name="{{$sellable->name}}" data-id="{{$sellable->id}}">Delete</button><br>
                        </p>
                        <!-- delete confirmation -->

                        <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" id="modal-text"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <form method="POST" action="{{route('provider.sellable.delete')}}">
                                        @csrf
                                        <input type="hidden" class="input-id" name="id"/>
                                        <button type="submit" class="btn btn-danger">Delete</button>
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


