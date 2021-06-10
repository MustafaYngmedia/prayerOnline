<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminPost;

class AdminPostController extends Controller
{
    public function allPost(){
        $data['all_posts'] = AdminPost::where('status',1)->paginate(10);
        return api()->ok('All Post',$data);
    }
    public function editPost(Request $request,$id = null){
        $data['post'] = null;
        if($id)
            $data['post'] = AdminPost::whereId($id)->first();
        return view('admin-posts.edit',$data);
    }
    public function listPosts(){
        $data['posts'] = AdminPost::latest()->paginate(10);
        return view('admin-posts.list',$data);
    }
    public function storePost(Request $request){
        if(!$request->id){
            $request->validate([
                'title'=>'required',
                'type'=>'required',
            ]);
            $post = new AdminPost;
        }else{
            $post = AdminPost::find($request->id);
        }

        $post->title = $request->title;
        $post->type = $request->type;
        $post->type_text = $request->text;
        $post->status = $request->status;
        if($request->hasFile('thumbnail')){
            $post->thumbnail = $this->fileUpload($request->thumbnail);
        }
        if($request->hasFile('file')){
            $post->link = $this->fileUpload($request->file);
        }
        $post->save();
        return back()->with('success','Post updated !!');
    }
    public function deletePosts($id){
        AdminPost::find($id)->delete();
        return back()->with('success','Post deleted');
    }
}
