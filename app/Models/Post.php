<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable=[
        'camp',
        'body',
        'season_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
