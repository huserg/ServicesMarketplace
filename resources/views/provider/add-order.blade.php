@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="card mb-5">
            <form method="POST" action="{{route('provider.order.create')}}">
                @csrf
                <div class="card-header">
                    <div class="form-group row pl-5 pr-5">
                        <label for="sellable_name" class="col-sm-auto col-form-label">Selected sellable</label>
                        <div class="col-sm-auto">
                            <input class="form-control" id="sellable_name" name="sellable_name" value="{{$sellable->name}}" disabled>
                        </div>
                        <input type="hidden" id="sellable" name="sellable" value="{{$sellable->id}}">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row p-5 pr-5">
                        <div class="col-sm-8 offset-sm-2">
                            <div class="form-group">
                                <label for="email">Client Mail</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{old('email')}}" required>
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger alert-dismissible fade show">{{ $errors->first('email') }}</div>
                                @else
                                    <br>
                                @endif
                            </div>

                            <hr>
                        </div>
                        <div class="col-sm-8 offset-sm-2">
                            @foreach ($fields as $field)
                                {!! $field !!}
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-dark w-auto" >Place order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection