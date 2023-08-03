<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Post;
use App\Models\Style;

class SeasonController extends Controller
{
   public function index(Season $season){
        return view('seasons.index')->with(['posts'=>$season->getPaginateBySeason(5), 'season' => $season]);
    }
    
    public function style(Post $post, Season $season, Style $style){
        $post = Post::where('season_id', $season->id)->where('style_id', $style->id)->orderBy('updated_at', 'DESC')->paginate(5);
        return view('styles.index')->with(['posts'=>$post, 'season' => $season]);
   }
}