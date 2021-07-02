<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminPost;
use Carbon\Carbon;
class AdminPostController extends Controller
{
    public function allPost(Request $request){
        $all_post = AdminPost::where('status',1);
        if($request->from != "" && $request->to != ""){
                $date_from = Carbon::parse($request->input('from'))->startOfDay();
                $date_to = Carbon::parse($request->input('to'))->endOfDay();
                $all_post = $all_post->whereBetween('created_at',[$date_from,$date_to]);
        }
$data["all_posts"] = $all_post->latest()->paginate(10);
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
