<?php

namespace App\Http\Controllers\Employer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employer\Register;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
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
	
	public function index()
	{
		if(Session::has('employer_id')){
			return redirect()->route('employer.dashboard');
		}
		$data['country'] = $this->getCountry();
        $data['state'] = $this->getState();
		return view('employer.register',$data);
	}

	public function checkEmail(Request $r)
	{
		if($r->email != null)
		{
			$exclude = $r->input('exclude');
			$query = DB::table('tbl_emp_user')->where('company_email', $r->email);
			
			if ( $exclude ) {
				$query = $query->where('company_id', '<>', $exclude);
			}
			
			$query = $query->get();
			
			if($query->count()) {
				return response()->json(['succes'=>false,'errors'=>['errors'=>['Email already registered.']]], 400);
			}
		}
		return response()->json(['succes'=>true], 200);
	}
	
	public function checkCompanyalias(Request $r)
    {
        if($r->code != null)
        {
            $data = DB::table('tbl_emp_user')->where('company_alias', $r->code)->first();
            if($data != null){
                return response()->json(['succes'=>false,'errors'=>['errors'=>['Company alias already exsist.']]], 400);
            }
        }
        return response()->json(['succes'=>true], 200);
    }
	
	public function store(Request $request)
	{
		$userToken = md5(uniqid(rand(), true));
		$_POST['company_password'] = Hash::make($_POST['company_password']);
		$_POST['company_token'] = $userToken;
		// $_POST['company_status'] = 'Pending';
		$_POST['company_status'] = 'Active';
		unset($_POST['_token']);
		unset($_POST['company_password_confirmation']);
		unset($_POST['g-recaptcha-response']);
		unset($_POST['agreement']);
		
		$insertData = DB::table('tbl_emp_user')->insert($_POST);
		if($insertData){
			$tokenUrl = url('employer/sign-up/verify/email/'.$userToken);
			$userEmail = $getFormData['email'];
			$mailData = array('name'=>$getFormData['name'],'user_verify_link'=>$tokenUrl);
   			/*$send_verification = Mail::send('main.emails.register', $mailData, function($message) use ($userEmail) {
		         $message->to($userEmail, 'infini jobs')->subject('Infini Job Email Verification');
		         $message->from('no-reply@inifini.com','Infini Jobs');
		      });*/
		    $send_verification = true;
   			if($send_verification){
   				Session::put('success','You\'ve successfully registered! Please verify your email address.');
            	return redirect()->route('employer.register');
   			}else{
   				Session::put('error','Opps !!! problem in sending email please contact administrator.');
            	return redirect()->route('employer.register');
   			}
   		}
	}

	public function verifyEmail($token)
	{
		if($token != null)
		{
			$register = array();
			$data = DB::table('tbl_emp_user')->where('company_token', $token)->first();
			if($data != null){
				$register['company_status'] = 'Active';
		        $register['company_token'] = '';
		        $updateData = DB::table('tbl_emp_user')->where('company_token', $token)->update($register);
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
		$email = DB::table('tbl_emp_user')->where('company_email',$getFormData['email'])->value('company_email');
		if($email == null)
		{
			return response()->json(array(
				'success' => false,
				'email' => $getFormData['email'],
				'errors' => ['errors' => ['This account does not exist']]
			), 400);
		}

		$userEmail = $getFormData['email'];
		$userPassword = trim($getFormData['password']);
		$checkLogin = DB::table('tbl_emp_user')->where('company_email',$userEmail)->where('company_status','Active')->first();
		if(count($checkLogin) > 0)
		{
			$isOk  = Hash::check($userPassword,$checkLogin->company_password);//password_verify
			if ($isOk){
				$employerId = $checkLogin->company_id;
				$employerName = $checkLogin->comapny_name;
				Session::put('employer_id', $employerId);
				Session::put('employer_name', $employerName);
				return response()->json(['success' => true, 'redir' => route('employer.dashboard'), 'msg'=>'You have successfully login..'], 200);
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
		$email = DB::table('tbl_emp_user')->where('company_email',$getFormData['email'])->value('company_email');
		if($email == null)
		{
			return response()->json(array(
				'success' => false,
				'errors' => ['errors' => ['This account does not exist']]
			), 400);
		}

		$userEmail = $getFormData['email'];
		$userPassword = $this->generateRandomString();
		$checkForgotPass = DB::table('tbl_emp_user')->where('company_email',$userEmail)->where('company_status','Active')->first();
		
		if(count($checkForgotPass) > 0)
		{
			$mailData = array('email'=>$userEmail,'password'=>$userPassword);
			$send_forgot_mail = Mail::send('main.emails.forgotpass', $mailData, function($message) use ($userEmail){
		         $message->to($userEmail, 'infini jobs')->subject('Infini Forgotpassword');
		         $message->from('no-reply@inifini.com','Infini Jobs');
		    });
		    $forgot['company_password'] = Hash::make($userPassword);
			$forgotData = DB::table('tbl_emp_user')->where('company_email',$userEmail)->update($forgot);
			return response()->json(['succes'=>true,'succes'=>['msg'=>['We have send new login details  to your register email.']]], 200);
		}
			
		return response()->json(array(
			'success' => false,
			'errors' => ['errors' => ['This account does not exist']]
		), 400);
	}

	public function dashboard()
	{
		$employerId = $this->getEmployerID();
		$employer = \App\Models\EmployerUser::where('company_id', $employerId)->first();
		$data['emp_details'] = $this->getEmployerDetails();
		$data['employer'] = $employer;
        return view('employer.dashboard',$data);
	}

	public function logout()
	{
		Session::forget('employer_id');
  		Session::forget('employer_name');
  		return redirect('/employer');
	}
	
	public function profile()
	{
		$employerId = $this->getEmployerID();
		$employer = \App\Models\EmployerUser::where('company_id', $employerId)->firstOrFail();
		
		$countries = DB::table('tbl_country')->get();
		$states = DB::table('tbl_state')->get();
		
		return view('employer.form', [
			'employer' => $employer,
			'countries' => $countries,
			'states' => $states
		]);
	}
	
	public function updateProfile(Request $request)
	{
		$employerId = $this->getEmployerID();
		$employer = \App\Models\EmployerUser::where('company_id', $employerId)->firstOrFail();
		
		$employer->company_email = $request->input('company_email');
		$employer->comapny_name = $request->input('comapny_name');
		$employer->company_reg_num = $request->input('company_reg_num');
		$employer->company_industry_id = $request->input('company_industry_id');
		$employer->company_size_id = $request->input('company_size_id');
		$employer->company_type_org_id = $request->input('company_type_org_id');
		$employer->company_description = $request->input('company_description');
		$employer->company_url = $request->input('company_url');
		$employer->company_tel_number = $request->input('company_tel_number');
		$employer->company_fax = $request->input('company_fax');
		$employer->company_country_id = $request->input('company_country_id');
		$employer->company_lat = $request->input('company_lat');
		$employer->company_long = $request->input('company_long');
		$employer->company_address = $request->input('company_address');
		$employer->company_postcode = $request->input('company_postcode');
		$employer->company_city = $request->input('company_city');
		$employer->company_state_id = $request->input('company_state_id');
		$employer->company_contact_person_name = $request->input('company_contact_person_name');
		$employer->company_cont_person_email = $request->input('company_cont_person_email');
		$employer->company_cont_person_position = $request->input('company_cont_person_position');
		$employer->company_cont_per_tel = $request->input('company_cont_per_tel');
		$employer->save();
		
		Session::put('success','Your profile has been added successfully');
		return redirect('employer/profile');
	}
	
	
	/* Kent's Codes */

	public function uploadPicture(Request $r)
	{
		try {
			$employerId = $this->getEmployerID();
			$type = $r->input('type');
			
			if (Input::hasFile('signFile')) {
                $file = Input::file('signFile');
                $fileArray = array('image' => $file);
                $rules = array('image' => 'mimes:jpeg,jpg,png,gif|required|max:30000');  
				$validator = Validator::make($fileArray, $rules);
                if ($validator->fails()){
                   return response()->json(["success"=>false,'error' => $validator->errors()->getMessages()], 400);
              	} else{
              		$destinationPath = 'public/uploads/employer/'.$employerId; // upload path
                    $extension = Input::file('signFile')->getClientOriginalExtension(); // getting image extension
                    $fileName = time() . '.' . $extension; // renameing image
                    Input::file('signFile')->move($destinationPath, $fileName);
                    $profile_image = url($destinationPath.'/'.$fileName);
                    
                    if ( $type == 'banner' ) {
                    	$profilepic['company_banner'] = $fileName;
                    } else {
                    	$profilepic['company_avatar'] = $fileName;
                    }
                    
					$forgotData = DB::table('tbl_emp_user')->where('company_id',$employerId)->update($profilepic);
                    return response()->json(['success' => true, 'profileImage' => $profile_image, 'msg'=>'Company logo has been uploaded.'], 200);
                }    
            }
        } catch (Exception $e) {
        	Log::error('Problem in update profile picture' . $ex->getMessage());
        }
	}
}
