<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    public function addComment(Request $request, $postId)
    {
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $postId;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back();
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        $user = Auth::user();
        if (!$user->isAdmin) {
            return response()->json(['error' => 'Вы не можете удалить этот комментарий'], 403);
        }
        $comment->delete();
        return redirect()->back();
    }
}