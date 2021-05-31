<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('user.tags.index', compact('tags')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = [
            'name' => 'required|string|max:50|unique:tags'
        ];
        // validation
        $request->validate($validation);
        $data = $request->all();

        // imposto lo slug partendo dal title
        $data['slug'] = Str::slug($data['name'], '-');

        // Insert
        Tag::create($data);

        // redirect
        return redirect()->route('user.tags.index')->with('message', 'Il tag è stato creato!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('user.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('user.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $validation = [
            'name' => 'required|string|max:50|unique:tags,name,' . $tag->id
        ];
        // validation
        $request->validate($validation);
        $data = $request->all();

        // imposto lo slug partendo dal title
        $data['slug'] = Str::slug($data['name'], '-');

        // Update
        $tag->update($data);

        return redirect()->route('user.tags.show', $tag)->with('message', 'Il tag ' . $tag->name . ' è stato modificato!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('user.tags.index')->with('message', 'Il tag è stato eliminato!');
    }
}
