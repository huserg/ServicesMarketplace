@extends('layouts.app')

@section('content')

    <div class="container">
            <div class="card">
                <div class="row p-5">
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
                        </div>Next booking
                        <hr>
                        <div class="row">
                            <h4 class="col title mb-3 font-weight-bold">Order it!</h4>
                        </div>
                        <div class="row m-1 m-2">
                            <form method="POST" action="{{ route('client.order') }}" class="col">
                                @foreach ($sellable->fields as $field)
                                    <div class="row form-group">
                                        <label for="{{$field->name}}" class="col-md-4 col-form-label text-md-left">{{$field->name}} <i class="fa fa-info-circle text-md-right" title="{{$field->description}}"></i></label>
                                        <div class="col-md-6">
                                            <input id="{{$field->name}}" type="{{$field->input_type}}" {!!$field->attributes!!} value="{{$field->value}}" class="form-control @error($field->name) is-invalid @enderror" name="{{$field->name}}" value="{{ old($field->name) }}" required>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn btn-primary"> Order now </a>
                            </div>
                        </div>
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card.// -->


    </div>
@endsection