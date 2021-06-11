<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
	public function user_like(){
		return $this->hasOne(PostLike::class,'user_id','post_id');
	}
    
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
