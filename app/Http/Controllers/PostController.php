<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Season;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('camps.index')->with(['posts'=>$post->get()]);
    }
    
    public function show(Post $post)
    {
        return view('camps.show')->with(['post'=>$post]);
    }
    
    public function create(Season $season, User $user)
    {
        return view('camps.create')->with(['seasons'=>$season->get(), 'user'=>$user]);
    }
    
    public function store(Request $request, Post $post)
    {
        $input=$request['post'];
        $post->fill($input)->save();
        return redirect('/posts/'.$post->id);
    }
    
    public function edit(Post $post, Season $season)
    {
        return view('camps.edit')->with(['post'=>$post, 'seasons'=>$season->get()]);
    }
    
    public function update(Request $request, Post $post)
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
