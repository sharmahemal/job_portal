<?php

namespace App\Http\Controllers\Jobseeker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jobseeker\Register;
use Illuminate\Support\Facades\Validator;
use App\Traits\CommonTrait;
use Session;
use DB;
use Response;
use Mail;
use Hash;

class SocialController extends Controller
{
	use CommonTrait;
	public function __construct() {
        error_reporting(0);
    }
	
	public function storeSocial(Request $request)
	{
		$userEmail = $request->user_email;
		$userFirstName = $request->first_name;
		$social_id = $request->social_id;
		$isLogin = $request->is_login;
		if($isLogin == "linkdin"){
			$Emaildata = DB::table('tbl_users')->where('user_email', $userEmail)->where('user_social_id', $social_id)->first();
		}else if($isLogin == "facebook"){
			$Emaildata = DB::table('tbl_users')->where('user_email', $userEmail)->where('user_social_id', $social_id)->first();
		}
		if($Emaildata != null){
			$jobSekkerId = $Emaildata->user_id;
			Session::put('jobsekker_id', $jobSekkerId);
			Session::put('jobsekker_name', $userFirstName);
			Session::put('jobsekker_login', $isLogin);
			return response()->json(['succes'=>false,'errors'=>['errors'=>['You have already register with us.']]], 400);
		}
		$register = array();
		$register['role_id'] = (int)1;
		$register['first_name'] = ucfirst($userFirstName);
		$register['user_email'] = trim($userEmail);
		$register['user_password'] = '';
		$register['user_customer_code'] = $this->generate_code('tbl_users','user_customer_code',8);
		$register['user_status'] = 'Active';
		$register['user_is_login'] =  ($isLogin == "linkdin") ? 'linkdin' : 'facebook';
		$register['user_social_id'] = $social_id;
		$register['user_created_id'] = (int)1;
		$register['user_updated_id'] = (int)1;
		$register['user_created_date'] = config('app.date');
		$register['user_updated_date'] = config('app.date');
		$insertData = DB::table('tbl_users')->insertGetId($register);
		if($insertData){
			$jobSekkerId = $insertData;
			Session::put('jobsekker_id', $jobSekkerId);
			Session::put('jobsekker_name', $userFirstName);
			Session::put('jobsekker_login', $isLogin);
			return response()->json(['succes'=>true,'succes'=>['msg'=>['You\'ve successfully registered!.']]], 200);
   		}
	}

}
