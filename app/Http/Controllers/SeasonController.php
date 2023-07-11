<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

class SeasonController extends Controller
{
    public function index(Season $season){
        return view('seasons.index')->with(['posts'=>$season->getPaginateBySeason(1)]);
    }
    
}
