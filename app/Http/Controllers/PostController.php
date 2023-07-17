<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Season;
use App\Http\Requests\PostRequest;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('camps.index')->with(['posts'=>$post->getPaginateBylimit(1)]);
    }
    
    public function show(Post $post)
    {
        $user = auth()->user();
        $post->user = $user;
        $post->loadCount('likes');
        // $post->like = Post::withCount('likes')->orderByDesc('updated_at')->get();
        // $like = Post::withCount('likes')->orderByDesc('updated_at')->get();
        return view('camps.show')->with(['post' => $post]);
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
    
    public function like(Request $request)
    {
        $user_id = Auth::user()->id;
        $post_id = $request->post_id;
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first();
        
        if(!$already_liked){
            $like = new Like;
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
        }else{
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param);
    }
    
}
