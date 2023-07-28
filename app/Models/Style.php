<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;
    
    public function getPaginateByStyle(int $limit_count=10){
        return $this->posts()->with('season')->with('style')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
