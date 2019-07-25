@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="card">
            <form method="POST" action="{{route('provider.order.update')}}">
                @csrf
                <input type="hidden" id="id" name="id" value="{{$order->id}}"/>

                <div class="card-header">
                    <div class="row">
                        <div class="font-weight-bold col-md-5">{{$order->sellable->name}}</div>
                        <div class="font-weight-bold col-md-5">{{$order->client->name}}</div>
                        <div class="font-weight-bold col-md-2">{{$order->price}} CHF</div>
                    </div>
                </div>
                <div class="card-body p-5">
                        @foreach ($fields as $field)
                            {!! $field !!}
                        @endforeach
                </div>
                <div class="card-footer">
                    <div class="row ">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-dark w-auto" >Update order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- card.// -->


    </div>

@endsection