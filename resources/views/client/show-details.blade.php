@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <form method="POST" action="{{ route('client.order') }}">
                @csrf
                <div class="card-body row p-5">
                    <div class="col-12">
                        <a href="#" data-fancybox=""><img class="img-fluid" src="{{ isset($sellable->image) ? $sellable->image : asset('images/default_sellable_image.jpg') }}"></a>
                    </div>
                    <hr class="p-2">
                    <div class="col-12">
                        <div class="row">
                            <h3 class="col title mb-3">{{$sellable->name}}</h3>
                        </div>
                        <div class="row">
                            <div class="col mb-3 m-2">
                                <var class="price h3 text-info">
                                    <span class="num">{{$sellable->price}} </span><span class="currency">CHF</span>
                                </var>
                            </div>
                        </div>
                        <div class="row">
                            <dl class="col m-2">
                                <dt>Description</dt>
                                <dd><p>{{$sellable->description}}</p></dd>
                            </dl>
                        </div>
                        @if (auth()->check())
                            <hr>
                            <div class="row">
                                <h4 class="col title mb-3 font-weight-bold">Order it!</h4>
                            </div>
                            <input type="hidden" name="sellable" value="{{$sellable->id}}">

                        @foreach ($fields as $field)
                            {!! $field !!}
                        @endforeach
                        @else
                            <hr>
                            <div class="row">
                                <p class="col title mb-3 font-weight-bold">Please login to place an order</p>
                            </div>
                        @endif

                    </div> <!-- row.// -->
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-center">
                            @if (auth()->check())
                            <input type="submit" class="btn btn-dark w-auto" value="Order now">
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- card.// -->
    </div>
@endsection