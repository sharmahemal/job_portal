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

class RegisterController extends Controller
{
	use CommonTrait;
	public function __construct() {
        error_reporting(0);
    }
	
	public function checkEmail(Request $r)
	{
		if($r->email != null)
		{
			$data = DB::table('tbl_users')->where('user_email', $r->email)->first();
			if($data != null){
				return response()->json(['succes'=>false,'errors'=>['errors'=>['Email already registered.']]], 400);
			}
		}
		return response()->json(['succes'=>true], 200);
	}
	
	
	public function store(Request $request)
	{
		
		$signupForm = $request['signup_form'];
		$parseForm = parse_str($signupForm, $getFormData);
		$userToken = md5(uniqid(rand(), true));
		$Emaildata = DB::table('tbl_users')->where('user_email', $getFormData['email'])->first();
		if($Emaildata != null){
			return response()->json(['succes'=>false,'errors'=>['errors'=>['Email already registered.']]], 400);
		}
		$register = array();
		$register['role_id'] = (int)1;
		$register['first_name'] = ucfirst($getFormData['name']);
		$register['user_email'] = trim($getFormData['email']);
		$register['user_password'] = Hash::make($getFormData['pass_confirmation']);
		$register['user_customer_code'] = $this->generate_code('tbl_users','user_customer_code',8);
		// $register['user_status'] = 'Pending';
		$register['user_status'] = 'Active';
		$register['user_is_login'] = 'web';
		$register['user_token'] = $userToken;
		$register['user_created_id'] = (int)1;
		$register['user_updated_id'] = (int)1;
		$register['user_created_date'] = config('app.date');
		$register['user_updated_date'] = config('app.date');
		$insertData = DB::table('tbl_users')->insert($register);
		if($insertData){
			$tokenUrl = url('jobseeker/sign-up/verify/email/'.$userToken);
			$userEmail = $getFormData['email'];
			$mailData = array('name'=>$getFormData['name'],'user_verify_link'=>$tokenUrl);
   			/*$send_verification = Mail::send('main.emails.register', $mailData, function($message) use ($userEmail) {
		         $message->to($userEmail, 'infini jobs')->subject('Infini Job Email Verification');
		         $message->from('no-reply@inifini.com','Infini Jobs');
		      });*/
   			$send_verification = true;
   			if(!$send_verification){
   				return response()->json(['succes'=>false,'errors'=>['errors'=>['Problem in sending verification email.']]], 400);
   			}else{
   				return response()->json(['succes'=>true,'succes'=>['msg'=>['You\'ve successfully registered! Please verify your email address.']]], 200);
   			}
   		}
	}

	public function verifyEmail($token)
	{
		if($token != null)
		{
			$register = array();
			$data = DB::table('tbl_users')->where('user_token', $token)->first();
			if($data != null){
				$register['user_status'] = 'Active';
		        $register['user_token'] = '';
		        $updateData = DB::table('tbl_users')->where('user_token', $token)->update($register);
				$verifyText = 'Greeting !!!, now you have successfully register with us.';
			}else{
				$verifyText = 'Invalid email verification token';
			}
		}else{
			$verifyText = 'Invalid email verification token';
		}
		$textData['verification_text'] = $verifyText;
		return view('main.email_verify',$textData);
	}

	public function login(Request $request)
	{
		$loginForm = $request['login_form'];
		$parseForm = parse_str($loginForm, $getFormData);
		$email = DB::table('tbl_users')->where('user_email',$getFormData['email'])->value('user_email');
		if($email == null)
		{
			return response()->json(array(
				'success' => false,
				'errors' => ['errors' => ['This account does not exist']]
			), 400);
		}

		$userEmail = $getFormData['email'];
		$userPassword = trim($getFormData['password']);
		$checkLogin = DB::table('tbl_users')->where('user_email',$userEmail)->where('user_status','Active')->first();
		if(count($checkLogin) > 0)
		{
			$isOk  = Hash::check($userPassword,$checkLogin->user_password);//password_verify
			if ($isOk){
				$jobSekkerId = $checkLogin->user_id;
				$jobSekkerName = $checkLogin->first_name;
				Session::put('jobsekker_id', $jobSekkerId);
				Session::put('jobsekker_name', $jobSekkerName);
				return response()->json(['success' => true, 'redir' => route('jobsekker.dashboard'), 'msg'=>'You have successfully login..'], 200);
			}
		}

		return response()->json(array(
			'success' => false,
			'errors' => ['errors' => ['Invalid Email and/or Password']]
		), 400);
	}

	public function forgotpassword(Request $request)
	{
		$forgotpassForm = $request['forgotpass_form'];
		$parseForm = parse_str($forgotpassForm, $getFormData);
		$email = DB::table('tbl_users')->where('user_email',$getFormData['email'])->value('user_email');
		if($email == null)
		{
			return response()->json(array(
				'success' => false,
				'errors' => ['errors' => ['This account does not exist']]
			), 400);
		}

		$userEmail = $getFormData['email'];
		$userPassword = $this->generateRandomString();
		$checkForgotPass = DB::table('tbl_users')->where('user_email',$userEmail)->where('user_status','Active')->first();
		
		if(count($checkForgotPass) > 0)
		{
			$mailData = array('email'=>$userEmail,'password'=>$userPassword);
			$send_forgot_mail = Mail::send('main.emails.forgotpass', $mailData, function($message) use ($userEmail){
		         $message->to($userEmail, 'infini jobs')->subject('Infini Forgotpassword');
		         $message->from('no-reply@inifini.com','Infini Jobs');
		    });
		    $forgot['user_password'] = Hash::make($userPassword);
			$forgotData = DB::table('tbl_users')->where('user_email',$userEmail)->update($forgot);
			return response()->json(['succes'=>true,'succes'=>['msg'=>['We have send new login details  to your register email.']]], 200);
		}
			
		return response()->json(array(
			'success' => false,
			'errors' => ['errors' => ['This account does not exist']]
		), 400);
	}

	public function dashboard()
	{
		return view('main.home');
	}

	public function logout()
	{
		session()->forget('jobsekker_id');
  		session()->forget('jobsekker_name');
  		return redirect('/');
	}
}
