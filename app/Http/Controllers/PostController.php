<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function show($id){
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->message = $validated['content'];
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()
            ->route('index')
            ->with('status', 'Post added');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update($id, Request $request)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:20',
        ]);

        $post->title = $validated['title'];
        $post->message = $validated['content'];
        $post->save();

        return redirect()
            ->route('index')
            ->with('status', 'Post edited');


    }


    public function destroy($id){
        if(auth::user()->is_admin){
            abort(403, 'Only admins can delete posts');
        }

        $post = Post::findOrfail($id);
        $likes = Like::where('post_id', '=',  $post->id)->delete();
        $post->delete();

        return redirect()->route('index')-with('statut', 'Post deleted');
    }
}
