<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', [
            'post' => Post::find($id)
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePost $request)
    { 
        $post = new Post();

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $post->slug = Str::slug($post->title, '-');
        $post->active = false;

        $post->save();

        $request->session()->flash('status', 'Post was created');

        return redirect()->route('posts.index');
    }
}
