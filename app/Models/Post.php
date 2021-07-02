<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
	public function user_like(){
		return $this->hasOne(PostLike::class,'post_id','id')->where('user_id',Auth::user()->id);
	}
    
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
