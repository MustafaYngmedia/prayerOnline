<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Obiefy\API\Facades\API;

use Auth;

class UserController extends Controller
{

    /**
     * Login or Register the User
     * @param Request $request
     * @return [type]
     */
    public function registerLogin(Request $request){
        $request->validate([
            'mobile'=>'required'
        ]);
        $mobile = $request->mobile;
        $user = User::firstOrCreate(['mobile' => $mobile]);
        $accessToken = $user->createToken('authToken')->accessToken;
        return api()->ok('Login Successfull', [ 'user' => $user, 'access_token' => $accessToken]);
    }
    /**
     * Getting the Current Login User
     * @param Request $request
     * @return [type]
     */
    public function getUserInfo(Request $request){
        return api()->ok("User Info",$request->user());
    }
    /**
     * @param Request $request
     * Update the User Info
     * @return [type]
     */
    public function updateUserInfo(Request $request){
        $user = $request->user();
        if($request->name)
            $user->name = $request->name;
        if($request->country)
            $user->country = $request->country;
        if($request->country_code)
            $user->country_code = $request->country_code;

        if($request->file('profile_pic'))
            $user->profile_pic = $this->fileUpload($request->profile_pic);

        $user->save();
        return api()->ok('User Updated',$user);
    }
    public function getAllCategories(Request $request){
        $categories = Category::where('status',1)->get();
        return api()->ok('All Categories',$categories);
    }
    public function logoutUser(Request $request){
        $user = Auth::user()->token();
        $user->revoke();
        return api()->ok('User Loggout');
    }
    public function userActivity(Request $request){
        $activity = $request->user()->logs()->latest()->get();        
        return api()->ok('User Activity',$activity);
    }
}
