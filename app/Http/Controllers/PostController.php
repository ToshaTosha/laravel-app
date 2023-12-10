<?php

namespace App\Http\Controllers;

use App\Listeners\PostValidateListener;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PostValidate;

class PostController extends Controller
{
    public function create(Request $request)
    {

        $user = Auth::user();
        $post = new Post([
            'content' => $request->input('content'),
            'public' => $request->has('public'),
            'user_id' => $user->id,
        ]);
        $post->save();
        event(new PostValidate($request));
        return redirect()->route('home');
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Вы не можете редактировать этот пост'], 403);
        }
        $post->content = $request->input('content');
        $post->public = $request->has('public');
        $post->save();
        return redirect()->route('home')->with('success', 'Пост успешно обновлен');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
        if ($post->user_id !== $user->id && !$user->isAdmin) {
            return response()->json(['error' => 'Вы не можете удалить этот пост'], 403);
        }
        $post->delete();
        return redirect()->route('home');
    }

    public function showCreateForm()
    {
        return view('posts.create');
    }

    public function showUpdateForm($postId)
    {
        $post = Post::find($postId);
        return view('posts.edit', ['post' => $post]);
    }

    public function publishPost($id)
    {
        $post = Post::findOrFail($id);
        $post->public = true;
        $post->save();
        return redirect()->back();
    }

    public function unPublishPost($id)
    {
        $post = Post::findOrFail($id);
        $post->public = false;
        $post->save();
        return redirect()->back();
    }

}
