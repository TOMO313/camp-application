<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Season;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('camps.index')->with(['posts'=>$post->getPaginateBylimit(1)]);
    }
    
    public function show(Post $post)
    {
        return view('camps.show')->with(['post'=>$post]);
    }
    
    public function create(Season $season)
    {
        $user=auth()->user();
        return view('camps.create')->with(['seasons'=>$season->get(), 'user'=>$user]);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input=$request['post'];
        $post->user_id=auth()->user()->id;
        $post->fill($input)->save();
        return redirect('/posts/'.$post->id);
    }
    
    public function edit(Post $post, Season $season)
    {
        return view('camps.edit')->with(['post'=>$post, 'seasons'=>$season->get()]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post=$request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/'.$post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
}
