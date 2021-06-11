<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentComment extends Model
{
    use HasFactory;
    public function sub_comment(){
        return $this->hasMany(SubComment::class,'parent_comment_id','id')->with('user')->limit(5);
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
