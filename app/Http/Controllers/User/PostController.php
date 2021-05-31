<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $validation = [
        'date' => 'required|date',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $posts = Post::where('user_id', $user_id)->get();

        return view('user.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('user.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validation;
        $validation['title'] = 'required|string|max:255|unique:posts';
        
        // validation
        $request->validate($validation);

        $data = $request->all();
        
        // controllo checkbox
        $data['published'] = !isset($data['published']) ? 0 : 1;
        // imposto lo slug partendo dal title
        $data['slug'] = Str::slug($data['title'], '-');
        // imposto lo user_id
        $data['user_id'] = Auth::id();
        // upload file image
        if ( isset($data['image']) ) {
            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        }

        // Insert
        $newPost = Post::create($data);    
        
        // aggiungo i tags
        if( isset($data['tags']) ) {
            $newPost->tags()->attach($data['tags']);
        }

        // redirect
        return redirect()->route('user.posts.index')->with('message', 'Il post è stato creato!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {   
        $user_id = Auth::id();
        
        if( $post->user_id != $user_id ) {
            abort('403');
        }

        return view('user.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // Controllo se l'utente è autorizzato alla modifica
        $user_id = Auth::id();
        
        if( $post->user_id != $user_id ) {
            abort('403');
        }

        $tags = Tag::all();

        return view('user.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Controllo se l'utente è autorizzato alla modifica
        $user_id = Auth::id();

        if( $post->user_id != $user_id ) {
            abort('403');
        }

        $validation = $this->validation;
        $validation['title'] = 'required|string|max:255|unique:posts,title,' . $post->id;

        // validation
        $request->validate($validation);

        $data = $request->all();
        
        // controllo checkbox
        $data['published'] = !isset($data['published']) ? 0 : 1;
        // imposto lo slug partendo dal title
        $data['slug'] = Str::slug($data['title'], '-');
        // upload file image
        if ( isset($data['image']) ) {
            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        }

        // Update
        $post->update($data);

        // aggiorno i tags
        if( !isset($data['tags']) ) {
            $data['tags'] = [];
        }
        $post->tags()->sync($data['tags']);

        // return
        return redirect()->route('user.posts.show', $post)->with('message', 'Il post ' . $post->title . ' è stato modificato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Controllo se l'utente è autorizzato alla modifica
        $user_id = Auth::id();

        if( $post->user_id != $user_id ) {
            abort('403');
        }

        $post->delete();

        return redirect()->route('user.posts.index')->with('message', 'Il post è stato eliminato!');
    }
}
