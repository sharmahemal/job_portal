<?php
namespace App\Traits;
use Session;
use App\Models\Jobseeker\Register;
use DB;
trait CommonTrait
{	
	
	public function generate_code($table, $col, $l)
	{
		switch($l)
		{
			case 5:
				$mi = 10000;
				$mx = 99999;
				break;
			
			case 8:
				$mi = 10000000;
				$mx = 99999999;
				break;
		}
		
		switch($table)
		{
			case 'tbl_users':
				if($l == 5)
				{
					$val = rand($mi, $mx);
				} else {
					do{
						$val = rand($mi, $mx);
						$data = Register::where($col, $val)->get();
					}while(!$data->isEmpty());
				}
				break;
		}
		return $val;
	}

	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	function getJobseekerProfilePic(){
		error_reporting(0);
		$sessionJobseekerId = $this->getJobseekerID();
		$profileImage = DB::table('tbl_users')->select('user_avatar')->where('user_id',$sessionJobseekerId)->first();
		$jobseekerImage = $profileImage->user_avatar;
		$destinationPath = 'public/uploads/jobseeker/'.$sessionJobseekerId; // upload path
        $profile_image = url($destinationPath.'/'.$jobseekerImage);
        if(!file_exists(public_path().'/uploads/jobseeker/'.$sessionJobseekerId.'/'.$jobseekerImage)){
        	$profile_image = url('public/uploads/dummy-image.png');
        }
        return $profile_image;
	}

	function getJobseekerDetails(){
		error_reporting(0);
		$sessionJobseekerId = $this->getJobseekerID();
		
		$jobseekerDetails = DB::table('tbl_users')
							->leftJoin('tbl_users_details', 'tbl_users_details.user_id', '=', 'tbl_users.user_id')
							->leftJoin('tbl_user_setting', 'tbl_user_setting.user_id', '=', 'tbl_users.user_id')
							->leftJoin('tbl_user_preferences', 'tbl_user_preferences.user_id', '=', 'tbl_users.user_id')
							->where('tbl_users.user_id', $sessionJobseekerId)
							->first();
		
		return $jobseekerDetails;
	}

	function getJobseekerID(){
		$sessionJobseekerId = session('jobsekker_id');
		return $sessionJobseekerId;
	}

	function getEmployerDetails(){
		error_reporting(0);
		$sessionEmployerId = $this->getEmployerID();
		$employerDetails = DB::table('tbl_emp_user')
							->where('tbl_emp_user.company_id',$sessionEmployerId)
							->first();
		return $employerDetails;
	}

	function getEmployerID(){
		$sessionEmployerId = session('employer_id');
		return $sessionEmployerId;
	}

	function getCountry(){
		$getCountry = DB::table('tbl_country')
							->where('country_status','Active')
							->get();
		return $getCountry;
	}

	function getState($country_id = ""){
		$getState = DB::table('tbl_state')
							->where('state_status','Active')
							->get();
		return $getState;
	}

	function getRace(){
		$getRace = DB::table('tbl_race')
							->where('race_status','Active')
							->get();
		return $getRace;
	}

	function getIndustry(){
		$getRace = DB::table('tbl_industry')
							->where('ind_status','Active')
							->get();
		return $getRace;
	}

	


}
