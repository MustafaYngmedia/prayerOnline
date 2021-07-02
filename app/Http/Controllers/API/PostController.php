<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\PostLike;


use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;


class PostController extends Controller
{
    public function newPost(Request $request,$id=null){
        $validator = Validator::make($request->all(),[
            'category_id'=>'required',
            'text'=>'required',
            'color'=>'required',
            'country'=>'required',
        ]);
        if($validator->fails()) {
            return api()->validation('Validation Error',$validator->messages());
        }

        if($request->id){
            $post = Post::find($id);
            $message = "Post Updated";
        }
        else{
            $post = new Post;
            $message = "New Post Added";
        }
        $post->category_id = $request->category_id;
        $post->text = $request->text;
        $post->color = $request->color;
        $post->country = $request->country;
        $post->user_id = $request->user()->id;
        $post->save();

        return api()->ok('New Post Added',$post);
    }

    public function userPosts(Request $request){
        $user_id = $request->user()->id;
        $posts = Post::with(['user_like'])->where('user_id',$user_id)->latest()->paginate(10);
        return api()->ok('User Posts',$posts);
    }
    public function getPost(Request $request,$id){
        $post = Post::with(['user','category','user_like'])->find($id);     
   return api()->ok('Post Id:'.$id,$post);
    }
public function deletePost(Request $request,$id){
$post = Post::find($id);
if($post == null){
	return api()->error('Cannot Find Post');
}
$post->delete();
return api()->ok('Post Deleted',$post);
}
    public function likePost(Request $request){
        $request->validate([
            'post_id'=>'required',
        ]);
        $post = Post::findOrFail($request->post_id);
        $isExists = PostLike::where(['post_id'=>$request->post_id,'user_id'=>$request->user()->id])->first();
        if($isExists != null){
		$isExists->delete();
		Post::find($request->post_id)->decrement('total_likes');
	 return api()->ok('Post Unliked');
        }
        $post->increment('total_likes'); 
        $post->save();

        PostLike::create([
            'post_id'=>$request->post_id,
            'user_id'=>$request->user()->id
        ]);
        $request->user()->logs()->create([
            'type'=>1,
            'post_id'=>$request->post_id,
        ]);
        return api()->ok('Like Added',$post);
    }
    public function allPost(Request $request){
        $all_post = Post::with(['user','user_like']);
	if($request->from != "" && $request->to != ""){
		$date_from = Carbon::parse($request->input('from'))->startOfDay();
		$date_to = Carbon::parse($request->input('to'))->endOfDay();
		$all_post = $all_post->whereBetween('created_at',[$date_from,$date_to]);
	}
if($request->category_id){
	$all_post = $all_post->where('category_id',$request->category_id);
}
if($request->country){
	$all_post = $all_post->where('country',$request->country);
}
//	if($request->country){
  //          $all_post = Post::with(['user','user_like'])->where('country',$request->country);
   //     }else{B
    //        $all_post = Post::with(['user','user_like'])->where('country',$request->user()->country);
     //   }

        $all_post = $all_post->latest()->paginate(10);
        return api()->ok('Latest Post',$all_post);
    }
}

