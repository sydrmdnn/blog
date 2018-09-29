<?php

namespace App\Http\Controllers;

use App\Story;
use App\Tag;
use Session;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $stories = Story::orderBy('updated_at', 'desc')
                        ->paginate(5);
        $trashed_stories = Story::onlyTrashed()
                                ->orderBy('deleted_at', 'desc')
                                ->get();
        return view('admin.stories.index', compact('stories', 'trashed_stories', 'tags'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.stories.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required|max:255',
            'image' => 'required',
            'url' => 'required',
            'tags' => 'required',
        ]);
        // Image handling
        // $image = $request->image;
        // $image_new_name = time() . $image->getClientOriginalName();
        // $image->move('path/to/where/', $image_new_name);
        // *****
        $story = new Story;
        $story->title = $request->title;
        $story->body = $request->body;
        $story->image = $request->image;
        $story->url = $request->url;
        $story->save();
        $story->tags()->attach($request->tags); // An array, attach to pivot table
        Session::flash('success', 'Story created!');
        return redirect()->route('story.index');
    }

    public function show(Story $story, $id)
    {
        $tags = Tag::all();
        $story = Story::find($id);
        return view('admin.stories.show', compact('story', 'tags'));
    }

    public function update(Request $request, Story $story, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required|max:255',
            'image' => 'sometimes',
            'url' => 'required',
        ]);
        $story = Story::find($id);
        // Image handling
        // if ($request->hasFile('image')) {
        //     $image = $request->image;
        //     $image_new_name = $image->getClientOriginalName();
        //     $image->move('path/to/where/', $image);
        //     $story->image = 'path/to/where/' . $image_new_name;
        // }
        // *****
        $story->title = $request->title;
        $story->body = $request->body;
        // $story->image = $request->image;
        $story->url = $request->url;
        $story->save();
        $story->tags()->sync($request->tags); // Sync the pivot table
        Session::flash('success', 'Story updated!');
        return redirect()->back();
    }

    public function delete(Story $story, $id)
    {
        $story = Story::find($id);
        $story->delete();
        Session::flash('success', 'Story deleted!');
        return redirect()->route('story.index');
    }

    public function destroy(Story $story, $id)
    {
        $trashed_story = Story::withTrashed()
                              ->where('id', $id)
                              ->first();
        $trashed_story->tags()->detach();
        $trashed_story->forceDelete();
        Session::flash('success', 'Story permanently deleted!');
        return redirect()->route('story.index');
    }

    public function restore(Story $story, $id)
    {
        $trashed_story = Story::onlyTrashed()
                              ->where('id', $id)
                              ->first();
        $trashed_story->restore();
        Session::flash('success', 'Story restored!');
        return redirect()->route('story.index');
    }
}
