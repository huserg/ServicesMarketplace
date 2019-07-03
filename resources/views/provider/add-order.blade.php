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
                                <label for="client">Client UID</label>
                                <input type="number" class="form-control" id="client" name="client" aria-describedby="clientHelp" value="{{old('client')}}">
                                @if ($errors->has('client'))
                                    <div class="alert alert-danger alert-dismissible fade show">{{ $errors->first('client') }}</div>
                                @else
                                    <br>
                                @endif
                            </div>

                            <hr>
                        </div>
                        <div class="col-sm-8 offset-sm-2">
                            @foreach ($sellable->fields as $field)
                                <div class="row form-group">
                                    <label for="{{$field->name}}" class="col-md-4 col-form-label text-md-left">{{$field->name}} <i class="fa fa-info-circle text-md-right" title="{{$field->description}}"></i></label>
                                    <div class="col-md-8">
                                        <input id="{{$field->name}}" type="{{$field->input_type}}" {!!$field->attributes!!} class="form-control @error($field->name) is-invalid @enderror" name="{{$field->name}}" value="{{ old($field->name) }}" required>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
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