@extends('layouts.app') @section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('partials.flash')
            <div class="card">
                <div class="card-header">
                <form action="{{ route('story.delete', ['id' => $story->id]) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm float-right">Delete</button>
                </form>
                Your Stories
                </div>
                <div class="card-body">
                    <form action="{{ route('story.update', ['id' => $story->id]) }}" method="POST">
                        @csrf @method('PATCH')
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="title" class="form-control" value="{{ $story->title }}"> @if ($errors->has('title'))
                            <p class="text-danger">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Body:</label>
                            <textarea name="body" class="form-control">{{ $story->body }}</textarea>
                            @if ($errors->has('body'))
                            <p class="text-danger">{{ $errors->first('body') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Image:</label>
                            <input type="file" name="image" class="form-control-file" value="{{ $story->image }}"> @if ($errors->has('image'))
                            <p class="text-danger">{{ $errors->first('image') }}</p>
                            @endif
                        </div>
                        <label>Tag:</label>
                        <div class="form-check form-group">
                            @foreach ($tags as $tag)
                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            @foreach ($story->tags as $t) {{-- Need to loop, many to many --}}
                                @if ($tag->id == $t->id)
                                    checked
                                @endif
                            @endforeach
                            >
                            <label class="form-check-label mr-5">
                                {{ $tag->name }}
                            </label>
                            @endforeach @if ($errors->has('tags'))
                            <p class="text-danger">{{ $errors->first('tags') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Slug:</label>
                            <input type="text" name="slug" class="form-control" value="{{ $story->slug }}"> @if ($errors->has('slug'))
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