<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentMail;

class BlogController extends Controller
{
    public function index()
    {
        // prendo i dati dal db
        $posts = Post::where('published', 1)->orderBy('date', 'asc')->get();
        $tags = Tag::all();
        // restituisco la pagina home
        return view('guest.index', compact('posts', 'tags'));
    }

    public function showPost($slug)
    {
        // prendo i dati dal db
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        
        if ( $post == null ) {
            abort(404);
        }
        // restituisco la pagina del post
        return view('guest.show-post', compact('post', 'tags'));
    }

    public function showTag($slug)
    {
        $tags = Tag::all();

        $currentTag = Tag::where('slug', $slug)->first();
        if ( $currentTag == null ) {
            abort(404);
        }

        $posts = $currentTag->posts()->where('published', 1)->get();

        return view('guest.show-tag', compact('posts', 'tags', 'currentTag'));
    }

    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'content' => 'required|string',
        ]);

        $newComment = new Comment();
        $newComment->name = $request->name;
        $newComment->content = $request->content;
        $newComment->post_id = $post->id;

        $newComment->save();

        // invio l'email di notifica
        Mail::to($post->user->email)->send(new CommentMail($post));

        return back();
    }

}
