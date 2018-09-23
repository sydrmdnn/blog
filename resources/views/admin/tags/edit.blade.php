@extends('layouts.app') @section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('partials.flash')
            <div class="card">
                <div class="card-header">Update tag</div>
                <div class="card-body">
                    <form action="{{ route('tag.update', ['id' => $tag->id]) }}" method="POST">
                        @csrf @method('PATCH')
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ $tag->name }}"> @if ($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <textarea name="description" class="form-control">{{ $tag->description }}</textarea>
                            @if ($errors->has('description'))
                            <p class="text-danger">{{ $errors->first('description') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Slug:</label>
                            <input type="text" name="slug" class="form-control" value="{{ $tag->slug }}"> @if ($errors->has('slug'))
                            <p class="text-danger">{{ $errors->first('slug') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            
@endsection