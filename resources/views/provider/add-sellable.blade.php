@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="card mb-5">
            <form method="POST" action="{{route('provider.sellable.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <div class="font-weight-bold">Add a new sellable</div>
                </div>
                <div class="card-body">
                    <div class="row p-5 pr-5">

                        <div class="col-12" id="form-outter-div">

                            <div class="form-group">
                                <label for="imageUpload">Sellable image</label>
                                <input class="form-control-file" type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" />
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger alert-dismissible fade show">{{ $errors->first('name') }}</div>
                                @else
                                    <br>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.05" class="form-control" id="price" name="price" aria-describedby="priceHelp" value="{{old('price')}}">
                                @if ($errors->has('price'))
                                    <div class="alert alert-danger alert-dismissible fade show">{{ $errors->first('price') }}</div>
                                @else
                                    <br>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea rows="10" class="form-control" id="description" name="description" aria-describedby="descriptionHelp">{{old('description')}}</textarea>
                                @if ($errors->has('description'))
                                    <div class="alert alert-danger alert-dismissible fade show">{{ $errors->first('description') }}</div>
                                @else
                                    <br>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Add personalized fields </label>
                                <br>
                                <button type="button" data-toggle="modal" data-target="#add-field-modal" class="btn btn-outline-dark w-auto"><span class="fa fa-plus"></span></button>
                                <br>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-dark w-auto">Create</button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="add-field-modal" tabindex="-1" role="dialog" aria-labelledby="add-field-modal-label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Choose a field type</h3>
                                <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                @foreach ($inputs as $input => $html)
                                    <a href="#" onclick="addPersonalizedField({{ json_encode($html) }})" class="list-group-item list-group-item-action btn btn-outline-dark">{{$input}}</a>
                                @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection