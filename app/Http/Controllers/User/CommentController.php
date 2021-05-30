<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('message', 'Il commento è stato eliminato!');
    }
}