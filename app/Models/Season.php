<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    
    public function getPaginateBySeason(int $limit_count = 10){
        return $this->posts()->with('season')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
