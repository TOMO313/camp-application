<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Post;

class ImageController extends Controller
{
    public function store(Request $request, Image $image)
    {
        $img = $request->file('path');
        $path = $img->store('img', 'public');
        Image::create([
             'path' => $path,
        ]);
        $image->post_id = $request->post_id;
        $image->save();
        return redirect('/posts/'. $image->post->id);
    }
}
