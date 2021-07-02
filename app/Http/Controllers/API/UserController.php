<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Country;
use App\Models\Category;
use App\Models\UserPhoneNumber;
use Illuminate\Http\Request;
//use Oiefy\API\Facades\API;

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
	$data['playstore_link'] = env('PLAYSTORE_LINK');
	$data['user'] = $request->user();
        return api()->ok("User Info",$request->user());
    }
    /**
     * @param Request $request
     * Update the User Info
     * @return [type]
     */
    public function updateUserInfo(Request $request){
        $user = $request->user();
//        $request->validate([
//		'email'=>'required|email|exists:users,email'
//	]);
	if($request->name)
            $user->name = $request->name;
        if($request->country)
            $user->country = $request->country;
        if($request->country_code)
            $user->country_code = $request->country_code;
	if($request->email){
	 $user->email = $request->email;
	}
	if($request->fcmToken){
	$user->fcmToken = $request->fcmToken;
	}
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
        $activity = $request->user()->logs()->latest()->paginate(10);
        return api()->ok('User Activity',$activity);
    }
    public function allPhoneNumber(Request $request){
	$request->validate([
		'phone_number'=>'required',
		'all_contacts'=>'required'
	]);
	$user = $request->user();
	$all_contacts = explode(",",$request->all_contacts);
	foreach($all_contacts as $contact){
	$isExists = UserPhoneNumber::where('user_id',$user->id)->where('phone_number',$contact)->first();
		if($isExists == null){
			$newUserContact = new UserPhoneNumber;
			$newUserContact->user_id = $user->id;
			$newUserContact->phone_number = $contact;
			$newUserContact->save();
		}
	}
	return api()->ok('User Request');
    }
    public function getAllCountries(){
     $countries = Post::select('country as name')->distinct()->orderBy('country')->get();
	return api()->ok('All Countries',$countries);
    }
    public function removeProfilePhoto(Request $request){
$user = $request->user();
$user->profile_pic = "";
$user->save();
return api()->ok("removed profile pic");
   }
}

