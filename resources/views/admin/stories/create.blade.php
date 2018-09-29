@extends('layouts.app') @section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('partials.flash')
            <div class="card">
                <div class="card-header">Create Stories</div>
                <div class="card-body">
                    <form action="{{ route('story.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="title" class="form-control"> @if ($errors->has('title'))
                            <p class="text-danger">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Body:</label>
                            <textarea name="body" class="form-control"></textarea>
                            @if ($errors->has('body'))
                            <p class="text-danger">{{ $errors->first('body') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Image:</label>
                            <input type="file" name="image" class="form-control-file"> @if ($errors->has('image'))
                            <p class="text-danger">{{ $errors->first('image') }}</p>
                            @endif
                        </div>
                        <div class="form-check form-group">
                            @foreach ($tags as $tag)
                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}">
                            <label class="form-check-label mr-5">
                                {{ $tag->name }}
                            </label>
                            @endforeach
                            @if ($errors->has('tags'))
                            <p class="text-danger">{{ $errors->first('tags') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Slug:</label>
                            <input type="text" name="url" class="form-control"> @if ($errors->has('url'))
                            <p class="text-danger">{{ $errors->first('url') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Post!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection