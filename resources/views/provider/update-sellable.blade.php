@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="card mb-5">
            <form method="POST" action="{{route('provider.sellable.update')}}">
                @csrf
                <input type="hidden" id="id" name="id" value="{{$sellable->id}}"/>
                <div class="card-body">
                    <div class="row p-5">
                        <div class="form-group">
                            <div class="col-12">
                                <a href="#" data-fancybox=""><img class="img-fluid" src="{{ isset($sellable->image) ? $sellable->image : asset('images/default_sellable_image.jpg') }}"></a>
                            </div>
                            <div class="col">
                                <input class="form-control-file" type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" />
                            </div>
                        </div>
                        <hr class="p-2">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{old('name') ? old('name') : $sellable->name}}">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger alert-dismissible fade show">{{ $errors->first('name') }}</div>
                                @else
                                    <br>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.05" class="form-control" id="price" name="price" aria-describedby="priceHelp" value="{{old('price') ? old('price') : $sellable->price}}">
                                @if ($errors->has('price'))
                                    <div class="alert alert-danger alert-dismissible fade show">{{ $errors->first('price') }}</div>
                                @else
                                    <br>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea rows="10" class="form-control" id="description" name="description" aria-describedby="descriptionHelp">{{old('description') ? old('description') : $sellable->description}}</textarea>
                                @if ($errors->has('description'))
                                    <div class="alert alert-danger alert-dismissible fade show">{{ $errors->first('description') }}</div>
                                @else
                                    <br>
                                @endif
                            </div>
                            @isset($fields)
                            @foreach ($fields as $field)
                                {!! $field !!}
                            @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-dark w-auto" >Update informations</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection