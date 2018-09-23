@extends('layouts.app') @section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('partials.flash')
            <div class="card">
                <div class="card-header">Your Stories
                    <a href="" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Trash</a>
                </div>
                <div class="card-body">
                    @if ($stories->count() > 0)
                    @foreach ($stories as $story)
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('story.show', ['id' => $story->id]) }}"><h4 class="font-weight-bold">{{ $story->title }}</h4>
                            </a>
                            <p class="text-monospace">{{ $story->body }}</p>
                            @foreach ($story->tags as $tag)
                            <span class="badge badge-primary">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    @endforeach
                    @else
                    <p>No story here..</p>
                    @endif
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Trashed story</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if ($trashed_stories->count() > 0) 
                            @foreach ($trashed_stories as $trashed_story)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6>{{ $trashed_story->title }}</h6>
                                    <p>{{ $trashed_story->body }}</p>
                                </div>
                                <div class="card-footer">
                                    <form action="{{ route('story.restore', ['id' => $trashed_story->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm float-right ml-2">Restore!</button>
                                    </form>
                                    <form action="{{ route('story.destroy', ['id' => $trashed_story->id]) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm float-right">Delete permanently!</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <p>Trash some here..</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection