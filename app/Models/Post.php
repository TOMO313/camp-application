<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
    
    protected $softCascade = ['images'];
    
    public function getPaginateBylimit(int $limit_count=10){
        return $this::with('season')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getByImage(int $limit_count = 10){
        return $this::with('images')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    protected $fillable=[
        'camp',
        'body',
        'season_id',
        'style_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function isLikedBy($user, $post):bool{
        return Like::where('user_id', $user->id)->where('post_id', $post->id)->first() !==null;
    }
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
     public function style()
    {
        return $this->belongsTo(Style::class);
    }
}
