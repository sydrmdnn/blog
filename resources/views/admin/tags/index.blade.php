@extends('layouts.app') @section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('partials.flash')
            <div class="card">
                <div class="card-header">Tags</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            @if ($tags->count() > 0) @foreach ($tags as $tag)
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{ $tag->name }}</h5>
                                    <p>{{ $tag->description }}</p>
                                    <p>{{ $tag->slug }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('tag.edit', ['id' => $tag->id ]) }}" class="btn btn-success btn-sm float-right ml-2">Update</a>
                                    <form action="{{ route('tag.destroy', ['id' => $tag->id]) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm float-right">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <br> @endforeach @else
                            <p>No tag here..</p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('tag.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Name:</label>
                                            <input type="text" name="name" class="form-control"> @if ($errors->has('name'))
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <textarea name="description" class="form-control"></textarea>
                                            @if ($errors->has('description'))
                                            <p class="text-danger">{{ $errors->first('description') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Slug:</label>
                                            <input type="text" name="slug" class="form-control"> @if ($errors->has('slug'))
                                            <p class="text-danger">{{ $errors->first('slug') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Add!</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection