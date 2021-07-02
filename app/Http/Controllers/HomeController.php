<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\ParentComment;
use App\Models\UserActivityLog;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show all the Users in System
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listUsers(Request $request){
        $data['users'] = User::latest()->where('isAdmin',0)->paginate(50);
        return view('user.list',$data);
    }

    public function listAdminUsers(){
        $data['users'] = User::where('isAdmin',1)->get();
        return view('admin.list',$data);
    }

    public function editUser(Request $request,$id = null){
        $data['user'] = null;
        if($id)
            $data['user'] = User::whereId($id)->first();
        return view('user.edit',$data);
    }
public function postAll(Request $request){
$all_posts = Post::with('user')->latest()->get();
//dd($all_posts);
return view('post.list',compact('all_posts'));
}
    public function editAdmin(Request $request,$id = null){
        $data['user'] = null;
        if($id)
            $data['user'] = User::whereId($id)->first();
        return view('admin.edit',$data);
    }
    public function storeUser(Request $request){
//dd($request->all());
      $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'mobile_number'=>'required|unique:users,mobile',
            'status'=>'required'
	]);

//dd($request->all());
        $newUser = User::updateOrCreate(['id' => $request->id],[
            'name'=>$request->name,
            'email'=>$request->email,
            'status'=>$request->status,
            'mobile'=>$request->mobile_number,
        'isAdmin'=>1
	]);

        if($request->password != null) User::updateOrCreate(['id'=>$newUser->id],['password'=> Hash::make($request->password)]);

        return back()->with('success','User updated !!');
    }
public function deletePost(Request $request,$id){
UserActivityLog::where('post_id',$id)->delete();
Post::find($id)->delete();
return back();
}
    public function storeAdmin(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$request->id,
            'mobile'=>'unique:users,mobile_number,'.$request->id,
            'status'=>'required'
        ]);

        $newUser = User::updateOrCreate(['id' => $request->id],[
            'name'=>$request->name,
            'email'=>$request->email,
            'status'=>$request->status,
            'mobile'=>$request->mobile_number,
            'isAdmin'=>1
	]);

        if($request->password != null) User::updateOrCreate(['id'=>$newUser->id],['password'=> Hash::make($request->password)]);

        return back()->with('success','User updated !!');
    }
    
    /**
     * @param Request $requestB
     * @return [type]
     */
    public function searchUser(Request $request){
        $request->validate([
            '_type'=>'required',
            'q'=>'required',
        ]);
        $q = $request->get('q');

        $users = User::orWhere('name', 'like', '%' . $q . '%')->
                            orWhere('mobile_number', 'like', '%' . $q . '%')->
                            orWhere('email', 'like', '%' . $q . '%')->get();
        $sendData = [];
        foreach($users as $c){
            $sendData[] = [
                'id'=>$c->id,
                'text'=>$c->name.' - '.$c->mobile_number.' - '.$c->email.' - '.$c->id
            ];
        }
        echo json_encode([
                "results"=>$sendData
        ]);
    }
public function deleteUser(Request $request,$id){
   $userPost = Post::where('user_id',$id)->delete();
   $activity = UserActivityLog::where('user_id',$id)->delete();
   $like  = PostLike::where('user_id',$id)->delete();
   $parentComment = ParentComment::where('user_id',$id)->delete();
	User::find($id)->delete();
return back()->with(['message'=>'Delete User']);
}
}
