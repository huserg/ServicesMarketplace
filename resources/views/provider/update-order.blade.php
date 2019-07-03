@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="card">
            <form method="POST" action="{{route('provider.order.update')}}">
                @csrf
                <input type="hidden" id="id" name="id" value="{{$order->id}}"/>

                <div class="card-header">
                    <div class="font-weight-bold">{{$order->sellable->name}}</div>
                </div>
                <div class="card-body">
                    <div class="row p-5">
                    </div> <!-- row.// -->
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