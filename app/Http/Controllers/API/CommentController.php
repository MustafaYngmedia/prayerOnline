<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ParentComment;
use App\Models\SubComment;
use App\Models\ParentCommentLike;

use Illuminate\Http\Request;
use Obiefy\API\Facades\API;
use Validator;

class CommentController extends Controller
{
    public function getPostComment(Request $request,$id){
        $comments = ParentComment::with(['user','sub_comment'])->where('post_id',$id)->paginate(10);
        return api()->ok('Comments',$comments);
    }
    public function getPostSubComment($id){
        $sub_comments = SubComment::with('user')->where('parent_comment_id',$id)->paginate(10);
        return api()->ok('SubComments',$sub_comments);
    }
   public function newParentComment(Request $request,$id=null){
       $request->validate([
           'text'=>'required',
           'post_id'=>'required',
       ]);

        if($id == null){
            $comment = new ParentComment;
            $message = "New Comment Added";
        }else{
            $comment = ParentComment::findOrFail($id);
            $message = "Comment Updated";

        }

        $comment->user_id = $request->user()->id;
        $comment->post_id = $request->post_id;
        $comment->text = $request->text;
        $comment->save();
        $request->user()->logs()->create([
            'type'=>2,
            'post_id'=>$request->post_id,
        ]);
        return api()->ok($message,$comment);
   }

   public function newSubComment(Request $request,$id = null){
        $validator = Validator::make($request->all(),[
           'parent_comment_id'=>'required',
           'text'=>'required',
        ],[
           'parent_comment_id.required'=>'Parent Comment ID is required',
           'text.required'=>'Comment Text is required', 
        ]);

       if ($validator->fails()) {
           return api()->validation('Validation Error',$validator->messages());
        }

       if($id == null){
            $comment = new SubComment;
            $message = "New Comment Added";
        }else{
            $comment = SubComment::findOrFail($id);
            $message = "Comment Updated";

        }

        $comment->user_id = $request->user()->id;
        $comment->parent_comment_id = $request->parent_comment_id;
        $comment->text = $request->text;
        $comment->save();
        $request->user()->logs()->create([
            'type'=>3,
            'post_id'=>$request->post_id,
        ]);
        return api()->ok($message,$comment);
    }
    public function commentLike(Request $request){
        $parent_comment = ParentComment::findOrFail($request->comment_id);
        $isExists = ParentCommentLike::where(['comment_id'=>$request->comment_id,'user_id'=>$request->user()->id,'type'=>0])->count();
        if($isExists > 0){
            return api()->validation('Like Already Exist');
        }
        $parent_comment->increment('total_likes'); 
        $parent_comment->save();

        ParentCommentLike::create([
            'comment_id'=>$request->comment_id,
            'user_id'=>$request->user()->id,
            'type'=>0
        ]);
        $request->user()->logs()->create([
            'type'=>4,
            'post_id'=>$request->post_id,
        ]);
        return api()->ok('Like Added',$parent_comment);
    }
    public function subCommentLike(Request $request){
        $parent_comment = SubComment::findOrFail($request->comment_id);
        $isExists = ParentCommentLike::where(['comment_id'=>$request->comment_id,'user_id'=>$request->user()->id,'type'=>1])->count();
        if($isExists > 0){
            return api()->validation('Like Already Exist');
        }
        $parent_comment->increment('total_likes'); 
        $parent_comment->save();

        ParentCommentLike::create([
            'comment_id'=>$request->comment_id,
            'user_id'=>$request->user()->id,
            'type'=>1
        ]);
        $request->user()->logs()->create([
            'type'=>5,
            'post_id'=>$request->post_id,
        ]);
        return api()->ok('Like Added',$parent_comment);
    }


    
}
