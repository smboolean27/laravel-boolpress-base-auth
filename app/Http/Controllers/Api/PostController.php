<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function search(Request $request)
    {
        //ricerca dei post per titolo
        $posts = Post::where('title' , 'like', '%' . $request->title . '%' )->get();
        //Response in Json
        return response()->json($posts);
    }
}
