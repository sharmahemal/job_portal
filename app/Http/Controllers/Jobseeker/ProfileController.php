<?php

namespace App\Http\Controllers\Jobseeker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jobseeker\Account;
use Illuminate\Support\Facades\Validator;
use App\Traits\CommonTrait;
use Session;
use DB;
use Response;
use Mail;
use Hash;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
	use CommonTrait;
	public function __construct() {
        error_reporting(0);
        
    }
	
	public function index()
	{
        $data['country'] = $this->getCountry();
        $data['state'] = $this->getState();
        $data['race'] = $this->getRace();
        $data['profile_pic'] = $this->getJobseekerProfilePic();
		    $data['jobseeker_details'] = $this->getJobseekerDetails();
        return view('jobsekker.profile',$data);
	}

	public function updateProfileDetails(Request $request)
	{
		try {
            $jobsekkerId = $this->getJobseekerID();
            $user = array();
            $userdetails = array();  
            $user['first_name'] = $request->input('first_name');
            $updateUser = DB::table('tbl_users')->where('user_id',$jobsekkerId)->update($user);
            #Check if country Other
            if($request->input('ud_country') == "other"){
                $state = '';
                $otherState = $request->input('ud_other_state');
            }else{
                $state = $request->input('ud_state');
                $otherState = '';
            }
            $userdetails['ud_gender'] = $request->input('ud_gender');
            $userdetails['ud_mobile'] = $request->input('ud_mobile');
            $userdetails['ud_dob'] = $request->input('ud_dob');
            $userdetails['ud_phone'] = $request->input('ud_phone');
            $userdetails['ud_address'] = $request->input('ud_address');
            $userdetails['ud_race'] = $request->input('ud_race');
            $userdetails['ud_marital'] = $request->input('ud_marital');
            $userdetails['ud_postalcode'] = $request->input('ud_postalcode');
            $userdetails['ud_city'] = $request->input('ud_city');
            $userdetails['ud_state'] = $state;
            $userdetails['ud_other_state'] = $otherState;
            $userdetails['ud_residining_country'] = $request->input('ud_residining_country');
            $userdetails['ud_nationality'] = $request->input('ud_nationality');
            $userdetails['ud_country'] = $request->input('ud_country');
            $userdetails['ud_reffreal'] = $request->input('ud_reffreal');
            $userdetails['ud_intro_vid'] = $request->input('ud_intro_vid');
            $userdetails['ud_created_id'] = (int)$jobsekkerId;
            $userdetails['ud_updated_id'] = (int)$jobsekkerId;
            $userdetails['ud_created_date'] = config('app.date');
            $userdetails['ud_updated_date'] = config('app.date');

            $checkProfileData = DB::table('tbl_users_details')->where('user_id', $jobsekkerId)->first();
            if($checkProfileData != null){
                $updateUserDetails = DB::table('tbl_users_details')->where('user_id',$jobsekkerId)->update($userdetails);
                unset($userdetails);
            }else{
                $userdetails['user_id'] = $jobsekkerId;
                $insertData = DB::table('tbl_users_details')->insert($userdetails);
                unset($userdetails);
            }
            Session::put('success','Your profile record has been successfully updated.');
            return redirect()->route('jobsekker.profile');
        } catch (Exception $e) {
        	Log::error('Problem in update input field' . $ex->getMessage());
        }
	}

    public function otherInfo()
    {
        $data['profile_pic'] = $this->getJobseekerProfilePic();
        $data['jobseeker_details'] = $this->getJobseekerDetails();
        return view('jobsekker.other-info',$data);
    }

    public function updateOtherInfo(Request $request)
    {
        try {
            $jobsekkerId = $this->getJobseekerID();
            $user = array();
            $user['ud_other_info'] = $request->input('ud_other_info');
            $user['ud_objective'] = $request->input('ud_objective');
            $updateUser = DB::table('tbl_users_details')->where('user_id',$jobsekkerId)->update($user);
            Session::put('success','Your othe info records has been successfully updated.');
            return redirect()->route('jobsekker.otherinfo');
        } catch (Exception $e) {
            Log::error('Problem in update input field' . $ex->getMessage());
        }
    }


    public function settings()
    {
        $data['profile_pic'] = $this->getJobseekerProfilePic();
        $data['jobseeker_details'] = $this->getJobseekerDetails();
        return view('jobsekker.settings',$data);
    }

    public function updateSettings(Request $request)
    {
        try {
            $jobsekkerId = $this->getJobseekerID();
            $setting = array();
            $setting['setting_resume_visibility'] = $request->input('setting_resume_visibility');
            $setting['setting_profile_visibility'] = $request->input('setting_profile_visibility');
            $setting['setting_email_alert'] = $request->input('setting_email_alert');
            $setting['setting_alert_freq'] = $request->input('setting_alert_freq');
            $setting['setting_newsletter'] = $request->input('setting_newsletter');
            $setting['setting_updated_date'] = config('app.date');
            
            $checkSettingData = DB::table('tbl_user_setting')->where('user_id', $jobsekkerId)->first();
            if($checkSettingData != null){
                $updateUser = DB::table('tbl_user_setting')->where('user_id',$jobsekkerId)->update($setting);
                unset($setting);
            }else{
                $setting['setting_profile_code'] = trim($request->input('setting_profile_code'));
                $setting['user_id'] = $jobsekkerId;
                $insertData = DB::table('tbl_user_setting')->insert($setting);
                unset($setting);
            }
            Session::put('success','Your settings records has been successfully updated.');
            return redirect()->route('jobsekker.settings');
        } catch (Exception $e) {
            Log::error('Problem in update input field' . $ex->getMessage());
        }
    }

    public function checkProfileCode(Request $r)
    {
        if($r->code != null)
        {
            $data = DB::table('tbl_user_setting')->where('setting_profile_code', $r->code)->first();
            if($data != null){
                return response()->json(['succes'=>false,'errors'=>['errors'=>['Profile code already exsist.']]], 400);
            }
        }
        return response()->json(['succes'=>true], 200);
    }

    #Preferenace 
    public function preferences()
    {
        $data['industry']  =  $this->getIndustry();
        $data['profile_pic'] = $this->getJobseekerProfilePic();
        $data['jobseeker_details'] = $this->getJobseekerDetails();
        return view('jobsekker.preferences',$data);
    }

    public function updatePreferences(Request $request)
    {
        try {
            $jobsekkerId = $this->getJobseekerID();
            $preferences = array();
            $pre_industry = implode(',',$request->input('pre_industry'));
            $pre_function = implode(',',$request->input('pre_function'));
            $pre_type = implode(',',$request->input('pre_type'));
            $pre_level = implode(',',$request->input('pre_level'));
            $pre_period = $request->input('pre_period');
            $pre_location = implode(',',$request->input('pre_location'));

            $preferences['pre_transport'] = $request->input('pre_transport');
            $preferences['pre_relocate'] = $request->input('pre_relocate');
            $preferences['pre_travel'] = $request->input('pre_travel');
            $preferences['pre_industry'] = $pre_industry;
            $preferences['pre_function'] = $pre_function;
            $preferences['pre_location'] = $pre_location;
            $preferences['pre_type'] = $pre_type;
            $preferences['pre_level'] = $pre_level;
            $preferences['pre_salary'] = $request->input('pre_salary');
            $preferences['pre_period'] = $pre_period;
            $preferences['pre_updated_date'] = config('app.date');
            
            $checkPreferencesData = DB::table('tbl_user_preferences')->where('user_id', $jobsekkerId)->first();
            if($checkPreferencesData != null){
                $updateUser = DB::table('tbl_user_preferences')->where('user_id',$jobsekkerId)->update($preferences);
                unset($preferences);
            }else{
                $preferences['user_id'] = $jobsekkerId;
                $insertData = DB::table('tbl_user_preferences')->insert($preferences);
                unset($preferences);
            }
            Session::put('success','Your preferences records has been successfully updated.');
            return redirect()->route('jobsekker.preferences');
        } catch (Exception $e) {
            Log::error('Problem in update input field' . $ex->getMessage());
        }
    }

######### MAHESH CODE ######################################################
public function storeEmployment(Request $request) {
  $IST = date("Y-m-d h:i:s");
  $emp_date_from = $request->emp_date_from_year . '-' . $request->emp_date_from_month . '-01';
  
  if ( $request>emp_date_to_present ) {
  	$emp_date_to = null;
  } else {
  	$emp_date_to = $request->emp_date_to_year . '-' . $request->emp_date_to_month . '-01';
  }
  
  $jobsekkerId = $this->getJobseekerID();
  DB::table('tbl_user_employements')->insert(
    ['user_id' => $jobsekkerId,
      'emp_name' => $request->emp_name,
      'emp_date_from' => $emp_date_from,
      'emp_date_to' => $emp_date_to,
      'emp_industry' => trim($request->emp_industry),
      'emp_postion' => $request->emp_postion,
      'emp_category' => trim($request->emp_category),
      'emp_type' => trim($request->emp_type),
      'emp_level' => trim($request->emp_level),
      'emp_responsibilities' => $request->emp_responsibilities,
      'emp_salary' => $request->emp_salary,
      'emp_achivement' => $request->emp_achivement,
      'emp_created_date' => $IST,
      'emp_updated_date' => $IST
    ]
  );
  return redirect('jobsekker/employment/list');
}

public function listEmployment() {
  $jobsekkerId = $this->getJobseekerID();
  $employements = DB::table('tbl_user_employements')->where('user_id', $jobsekkerId)->orderBy('emp_date_from', 'desc')->get();
  return view('jobsekker.employment', ['employements' => $employements,'profile_pic' => $this->getJobseekerProfilePic()]);
}

public function editEmployment($id) {
  
  $employements = DB::table('tbl_user_employements')->where('emp_id', $id)->first();
  return view('jobsekker.editEmployment', ['employments' => $employements,'profile_pic' => $this->getJobseekerProfilePic()]);
}

public function deleteEmployment($id) {
  DB::table('tbl_user_employements')->where('emp_id', '=', $id)->delete();
  return redirect('jobsekker/employment/list');
}


public function updateEmployment(Request $request) {
  $IST = date("Y-m-d h:i:s");
  $emp_date_from = $request->emp_date_from_year . '-' . $request->emp_date_from_month . '-01';
  
  if ( $request->input('emp_date_to_present') ) {
  	$emp_date_to = null;
  } else {
  	$emp_date_to = $request->emp_date_to_year . '-' . $request->emp_date_to_month . '-01';
  }

  $emp_id = $request->input('emp_id');
  $employement['emp_name'] = $request->input('emp_name');
  $employement['emp_date_from'] = $emp_date_from;
  $employement['emp_date_to'] = $emp_date_to;
  $employement['emp_industry'] = trim($request->input('emp_industry'));
  $employement['emp_postion'] = $request->input('emp_postion');
  $employement['emp_category'] = trim($request->input('emp_category'));
  $employement['emp_type'] = trim($request->input('emp_type'));
  $employement['emp_level'] = trim($request->input('emp_level'));
  $employement['emp_responsibilities'] = $request->input('emp_responsibilities');
  $employement['emp_salary'] = $request->input('emp_salary');
  $employement['emp_achivement'] = $request->input('emp_achivement');
  $employement['emp_updated_date'] = $IST;

  $updateUser = DB::table('tbl_user_employements')->where('emp_id', $emp_id)->update($employement);
  return redirect('jobsekker/employment/list');

}

// Reference controller----
public function storeReference(Request $request) {
  $IST = date("Y-m-d h:i:s");
  $jobsekkerId = $this->getJobseekerID();
  DB::table('tbl_user_references')->insert(
    ['user_id' => $jobsekkerId,
      'ref_name' => $request->ref_name,
      'ref_title' => $request->ref_title,
      'ref_company' => $request->ref_company,
      'ref_contact' => $request->ref_contact,
      'ref_email' => $request->ref_email,
      'ref_created_date' => $IST,
      'ref_updated_date' => $IST
    ]
  );
  return redirect('jobsekker/reference/list');
}

public function listReference() {
  $jobsekkerId = $this->getJobseekerID();
  $references = DB::table('tbl_user_references')->where('user_id', $jobsekkerId)->get();
  return view('jobsekker.reference', ['references' => $references,'profile_pic' => $this->getJobseekerProfilePic()]);
}

public function editReference($id) {
  $references = DB::table('tbl_user_references')->where('ref_id', $id)->first();
  return view('jobsekker.editReference', ['references' => $references,'profile_pic' => $this->getJobseekerProfilePic()]);
}

public function deleteReference($id) {
  DB::table('tbl_user_references')->where('ref_id', '=', $id)->delete();
  return redirect('jobsekker/reference/list');
}


public function updateReference(Request $request) {
  $IST = date("Y-m-d h:i:s");
  $ref_id = $request->input('ref_id');
  $reference['ref_name'] = $request->input('ref_name');
  $reference['ref_title'] = $request->input('ref_title');
  $reference['ref_company'] = $request->input('ref_company');
  $reference['ref_contact'] = $request->input('ref_contact');
  $reference['ref_email'] = $request->input('ref_email');
  $reference['ref_updated_date'] = $IST;

  $updateRef = DB::table('tbl_user_references')->where('ref_id', $ref_id)->update($reference);
  return redirect('jobsekker/reference/list');

}

// education controller
public function storeEducation(Request $request) { //echo 'test'; exit;
  $IST = date("Y-m-d h:i:s");
  $jobsekkerId = $this->getJobseekerID();
  DB::table('tbl_user_education')->insert(
    ['user_id' => $jobsekkerId,
      'edu_edu_level' => trim($request->edu_edu_level),
      'edu_course' => trim($request->edu_course),
      'edu_major' => $request->edu_major,
      'edu_university' => $request->edu_university,
      'edu_completion' => trim($request->edu_completion),
      'edu_result' => $request->edu_result,
      'edu_add_info' => $request->edu_add_info,
      'edu_created_date' => $IST,
      'edu_updated_date' => $IST
    ]
  );

  return redirect('jobsekker/education/list');
}

public function listEducation() {
  $jobsekkerId = $this->getJobseekerID();
  $educations = DB::table('tbl_user_education')->where('user_id', $jobsekkerId)->get();
  return view('jobsekker.education', ['educations' => $educations,'profile_pic' => $this->getJobseekerProfilePic()]);
}

public function editEducation($id) {
  $educations = DB::table('tbl_user_education')->where('edu_id', $id)->first();
  return view('jobsekker.editEducation', ['educations' => $educations,'profile_pic' => $this->getJobseekerProfilePic()]);
}

public function deleteEducation($id) {
  DB::table('tbl_user_education')->where('edu_id', '=', $id)->delete();
  return redirect('jobsekker/education/list');
}


public function updateEducation(Request $request) {
  $IST = date("Y-m-d h:i:s");

  $edu_id = $request->input('edu_id');
  $education['edu_edu_level'] = trim($request->input('edu_edu_level'));
  $education['edu_course'] = trim($request->input('edu_course'));
  $education['edu_major'] = $request->input('edu_major');
  $education['edu_university'] = $request->input('edu_university');
  $education['edu_completion'] = trim($request->input('edu_completion'));
  $education['edu_result'] = $request->input('edu_result');
  $education['edu_add_info'] = $request->input('edu_add_info');
  $education['edu_updated_date'] = $IST;

  $updateRef = DB::table('tbl_user_education')->where('edu_id', $edu_id)->update($education);
  return redirect('jobsekker/education/list');

}

// Skill controller
public function listSkill() {
  $jobsekkerId = $this->getJobseekerID();
  
 $tech_skills = DB::table('tbl_user_skills')->where('user_id', $jobsekkerId)->where('skill_type', 'tech')->get();
  $soft_skills = DB::table('tbl_user_skills')->where('user_id', $jobsekkerId)->where('skill_type', 'soft')->get();
  //print_r($tech_skills); exit;
  return view('jobsekker.skill', ['tech_skills' => $tech_skills,'soft_skills' => $soft_skills,'profile_pic' => $this->getJobseekerProfilePic()]);
}

public function storeSkill(Request $request) {
    $jobsekkerId = $this->getJobseekerID();
  //DB::table('tbl_user_skills')->truncate();
  DB::table('tbl_user_skills')->where('user_id', '=', $jobsekkerId)->delete();
  $IST = date("Y-m-d h:i:s");
  $techs = $request->tech;
  if ($techs != '' && count($techs) > 0) {
    $tech_val = $request->tech_val;
    foreach($techs as $i => $tech) {
      $skill_type = 'tech';
      if ($tech != '' && $i < 5) {
        DB::table('tbl_user_skills')->insert(
          ['user_id' => $jobsekkerId,
            'skill_title' => $tech,
            'skill_val' => $tech_val[$i],
            'skill_type' => $skill_type,
            'skill_created_date' => $IST,
            'skill_updated_date' => $IST
          ]
        );
      }
    }
  }
  $softs = $request->soft;
  if ($softs != '' && count($softs) > 0) {
    $soft_val = $request->soft_val;
    foreach($softs as $i => $soft) {
      $skill_type = 'soft';
      if ($soft != '' && $i < 3) {
        DB::table('tbl_user_skills')->insert(
          ['user_id' => $jobsekkerId,
            'skill_title' => $soft,
            'skill_val' => $soft_val[$i],
            'skill_type' => $skill_type,
            'skill_created_date' => $IST,
            'skill_updated_date' => $IST
          ]
        );
      }
    }
  }
  return redirect('jobsekker/skill/list');
}

public function deleteSkill($id) {
  DB::table('tbl_user_skills')->where('skill_id', '=', $id)->delete();
  return redirect('jobsekker/skill/list');
}

    
// Languages controller
public function listLanguage() {
  $jobsekkerId = $this->getJobseekerID();
  $languages = DB::table('tbl_user_languages')->where('user_id', $jobsekkerId)->get();
  //echo '<pre>'; print_r($languages); echo '</pre>'; exit;
  return view('jobsekker.language', ['languages' => $languages,'profile_pic' => $this->getJobseekerProfilePic()]);
}

public function storeLanguage(Request $request) {
    //print_r($_POST); exit;
    $jobsekkerId = $this->getJobseekerID();
  DB::table('tbl_user_languages')->where('user_id', '=', $jobsekkerId)->delete();
  $IST = date("Y-m-d h:i:s");
  $lang_titles = $request->lang_title;
  if ($lang_titles != '' && count($lang_titles) > 0) {
    $lang_speak = $request->lang_speak;
    $lang_write = $request->lang_write;
    foreach($lang_titles as $i => $lang_title) {
      if ($lang_title != '' && $i < 4) {
        DB::table('tbl_user_languages')->insert(
          [ 'lang_title' => trim($lang_title),
            'lang_speak' => trim($lang_speak[$i]),
            'lang_write' => trim($lang_write[$i]),
            'user_id' => $jobsekkerId,
            'lang_created_date' => $IST,            
            'lang_updated_date' => $IST
          ]
        );
      }
    }
  }
  return redirect('jobsekker/language/list');
}
	
	public function deleteLanguage($id) {
	  DB::table('tbl_user_languages')->where('lang_id', '=', $id)->delete();
	  return redirect('jobsekker/language/list');
	}

	//Job Search
	public function jobSearch(Request $request) {
	    $posts = \App\Models\JobPost::orderBy('post_created_date', 'desc');
	    
		if ( $keyword = $request->input('keyword') ) {
			$posts->where(function($query) use ($keyword) {
				$query->where('post_title', 'like', '%' . $keyword . '%')
					  ->orWhere('post_category', 'like', '%' . $keyword . '%');
			});
		}
		
		if ( $location = $request->input('location') ) {
			$posts->where('post_state', $location);
		}
		
		if ( $request->input('lat') && $request->input('lon') ) {
			$miles = 5;
			$lat = $request->input('lat');
			$lon = $request->input('lon');
			$posts->whereRaw("post_lat BETWEEN {$lat} - ({$miles} * 0.018) AND {$lat} + ({$miles} * 0.018)");
			$posts->whereRaw("post_long BETWEEN {$lon} - ({$miles} * 0.018) AND {$lon} + ({$miles} * 0.018)");
		}
		
		if ( $request->input('sort') ) {
			switch ( $request->input('sort') ) {
				case 'publish_date':
					$posts = $posts->orderBy('post_created_date', 'desc');
					break;
				case 'position':
					$posts = $posts->orderBy('post_position', 'desc');
					break;
				case 'company':
					$posts = $posts->orderBy('post_created_id', 'desc');
					break;
			}
		}
		
		if ( $request->ajax() ) {
			$posts = $posts->get();
			$data = [];
			
			foreach ( $posts as $post ) {
				$data[] = [
					'id' => $post->id,
					'title' => $post->post_title,
					'company' => $post->employerUser->comapny_name,
					'lat' => $post->post_lat,
					'lon' => $post->post_long
				];
			}
			
			return response()->json($data);
		} else {
			return view('jobsekker.jobSearch', [
				'posts' => $posts->paginate(20)
			]);
		}
	}

	
	public function jobDetail(Request $request, $id)
	{
		$jobseeker = \App\Models\Jobseeker::where('user_id', $this->getJobseekerID())->first();
		$post = \App\Models\JobPost::findOrFail($id);
		
		$exists = DB::table('tbl_user_post')->where('user_id', $this->getJobseekerID())->where('post_id', $id)->get();
		
		return view('job.detail', [
			'post' => $post,
			'jobseeker' => $jobseeker,
			'exists' => ($exists->count() > 0)
		]);
	}
	
	public function applyJob(Request $request)
	{
		$this->validate($request, [
			'resume' => 'required|integer',
			'salary' => 'required|numeric',
			'post_id' => 'required|exists:tbl_comp_post,id'
		]);
		
		$jobseekerId = $this->getJobseekerID();
		$postId = $request->input('post_id');
		$jobseeker = \App\Models\Jobseeker::where('user_id', $jobseekerId)->firstOrFail();
		$resumeId = $request->input('resume');
		$salary = $request->input('salary');
		
		// $jobseeker->posts()->attach($postId, ['resume_id' => $resumeId, 'salary' => $salary]);
		
		DB::table('tbl_user_post')->insert([
			'post_id' => $postId,
			'user_id' => $jobseekerId,
			'resume_id' => $resumeId,
			'salary' => $salary,
			'created_at' => date('Y-m-d H:i:s')
		]);
		
		return response()->json(['success' => true]);
	}
	
	public function updatePassword(Request $request)
	{
		$id = $this->getJobseekerID();
		$jobseeker = \App\Models\Jobseeker::where('user_id', $id)->firstOrFail();
		$currentPassword = $request->input('current_password');
		$newPassword = $request->input('new_password');
		$retypePassword = $request->input('retype_password');
		
		$isOk = Hash::check($currentPassword, $jobseeker->user_password);
		$match = ($newPassword == $retypePassword);
		
		if ( $isOk &&  $match ) {
			$jobseeker->user_password = Hash::make($newPassword);
			
			return response()->json(['success' => true]);
		} else {
			if ( !$isOk ) {
				return response()->json(['error' => true, 'message' => 'Wrong password entered.']);
			} else {
				return response()->json(['error' => true, 'message' => 'Your retype password not match.']);
			}
		}
	}
	
	public function resumes()
	{
		$jobseekerId = $this->getJobseekerID();
		$jobseeker = \App\Models\Jobseeker::where('user_id', '=', $jobseekerId)->firstOrFail();
		
		return view('jobsekker.resumes', [
			'profile_pic' => $this->getJobseekerProfilePic(),
			'jobseeker' => $jobseeker
		]);
	}
	
	public function deleteResume(Request $request)
	{
		$this->validate($request, [
			'id' => 'required|min:1'
		]);
		
		$id = $request->input('id');
		
		$resume = \App\Models\Resume::findOrFail($id);
		
		$file = public_path('uploads/jobseeker/' . $this->getJobseekerID() . '/' . $resume->filename);
		
		if ( file_exists($file) ) {
			unlink($file);
		}
		
		$resume->delete();
		
		return response()->json([
			'success' => true
		]);
	}
	
	public function uploadResume(Request $request)
	{
		$this->validate($request, [
			'file' => 'required|mimes:doc,docx,pdf|max:' . 2 * 1024
		]);
		
		$jobseekerId = $this->getJobseekerID();
		
		$path = public_path('uploads/jobseeker/' . $jobseekerId . '/');
		$newFilename = md5(time() . $jobseekerId) . '.' . $request->file->getClientOriginalExtension();
		
		/*return response()->json([
			'path' => $path,
			'filename' => $newFilename,
		]);*/
		
		Input::file('file')->move($path, $newFilename);
		
		$resume = new \App\Models\Resume;
		$resume->user_id = $jobseekerId;
		$resume->filename = $newFilename;
		$resume->default_filename = $request->file->getClientOriginalName();
		$resume->status = 'Active';
		$resume->created_at = date('Y-m-d H:i:s');
		$resume->save();
		
		return response()->json([
			'success' => true,
			'id' => $resume->id,
			'filename' => $resume->filename,
			'url' => url('public/uploads/jobseeker/' . $jobseekerId . '/' , $newFilename),
		]);
	}
	
	public function bookmark(Request $request)
	{
		$postId = $request->input('id');
		$jobseekerId = $this->getJobseekerID();
		
		$result = DB::table('tbl_bookmarks')->where('post_id', $postId)->where('user_id', $jobseekerId)->get();
		
		if ( $result->count() ) {
			DB::table('tbl_bookmarks')->where('post_id', $postId)->where('user_id', $jobseekerId)->delete();
		} else {
			DB::table('tbl_bookmarks')->insert([
				'user_id' => $jobseekerId,
				'post_id' => $postId,
				'created_at' => date('Y-m-d H:i:s')
			]);
		}
		
		return response()->json(['success' => true]);
	}
}
