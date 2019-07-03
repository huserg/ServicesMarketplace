@extends('layouts.admin')

@section('content')

    @isset ($message_alert)
        <div class="alert alert-danger text-center" role="alert">
            {{$message_alert}}
        </div>
    @endisset

    @if (!isset($sellables[0]))
        <div class="alert alert-warning text-center" role="alert">
            You don't have any services yet. You can create one <a href="{{route('provider.sellable.add')}}">here</a>.
        </div>
    @endif

    <br>
    <article class="itemlist">
        <div class="row row-sm">
            <aside class="col-sm-3">
            </aside>
            <div class="col-sm-6">
                <div class="text-wrap">
                    <h2 class="title"> Your sellables</h2>
                </div>
            </div>
            <aside class="col-sm-3">
                <div class="border-left pl-3">
                    <p class="">
                        <a href="{{route('provider.sellable.add')}}"  class="btn btn-dark">Add a new sellable</a>
                    </p>
                </div>
            </aside>
        </div>
    </article>

    <hr>

    @foreach ($sellables as $sellable)
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
                        <p class="price-wrap">
                            <span class="btn btn-price btn-manage-p"> {{$sellable->price}} CHF</span>
                        </p> <!-- info-price-detail // -->
                        <p class="">
                            <a href="{{route('provider.sellable.manage', $sellable->id)}}" class="btn btn-dark btn-manage-p">Manage</a>
                        </p>
                        <p class="">
                            <a href="{{route('provider.sellable.order', $sellable->id)}}" class="btn btn-dark btn-manage-p">Order for client</a>
                        </p>
                        <p class="">
                            <button data-toggle="modal" data-target="#confirm-delete-modal" class="btn btn-danger btn-manage-p" data-name="{{$sellable->name}}" data-id="{{$sellable->id}}">Delete</button><br>
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


