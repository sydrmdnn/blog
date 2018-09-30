<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Session;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->get();
        return view('admin.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
        ]);
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->url = $request->url;
        $tag->save();
        Session::flash('success', 'Tag created!');
        return redirect()->back();
    }

    public function edit(Tag $tag, $id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
        ]);
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->url = $request->url;
        $tag->save();
        Session::flash('success', 'Tag updated!');
        return redirect()->route('tag.index');
    }

    public function destroy(Tag $tag, $id)
    {
        $tag = Tag::find($id);
        $tag->stories()->detach();
        $tag->delete();
        Session::flash('success', 'Tag deleted!');
        return redirect()->back();
    }
}
