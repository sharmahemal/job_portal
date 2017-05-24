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

class AccountController extends Controller
{
	use CommonTrait;
	public function __construct() {
        error_reporting(0);
    }
	
	public function index()
	{
		$userPosts = DB::table('tbl_user_post')
			->join('tbl_comp_post', 'tbl_comp_post.id', '=', 'tbl_user_post.post_id')
			->join('tbl_emp_user', 'tbl_comp_post.post_created_id', '=', 'tbl_emp_user.company_id')
			->where('tbl_user_post.user_id', $this->getJobseekerID())->orderBy('tbl_user_post.created_at', 'desc')->get();
		
		$savedPosts = DB::table('tbl_bookmarks')
			->select('tbl_comp_post.*')
			->join('tbl_comp_post', 'tbl_bookmarks.post_id', '=', 'tbl_comp_post.id')
			->where('tbl_bookmarks.user_id', $this->getJobseekerID())
			->paginate(20);
		
		$data['jobseeker_details'] = $this->getJobseekerDetails();
		$data['profile_pic'] = $this->getJobseekerProfilePic();
		$data['userPosts'] = $userPosts;
		$data['savedPosts'] = $savedPosts;
		
		return view('jobsekker.myaccount',$data);
	}
	
	public function cancelApplication(Request $request)
	{
		$userPostId = $request->input('id');
		$userId = $this->getJobseekerID();
		
		DB::table('tbl_user_post')->where('post_id', $userPostId)->where('user_id', $userId)->delete();
		
		return response()->json(['success' => true]);
	}

	public function updateProfilePic(Request $r)
	{
		try {
			if (Input::hasFile('signFile')) {

                $file = Input::file('signFile');
                $fileArray = array('image' => $file);
                $rules = array('image' => 'mimes:jpeg,jpg,png,gif|required|max:30000');  
				$validator = Validator::make($fileArray, $rules);
                if ($validator->fails()){
                   return response()->json(["success"=>false,'error' => $validator->errors()->getMessages()], 400);
              	} else{
              		$session_jobseeker_id = $this->getJobseekerID();
					$destinationPath = 'public/uploads/jobseeker/'.$session_jobseeker_id; // upload path
                    $extension = Input::file('signFile')->getClientOriginalExtension(); // getting image extension
                    $fileName = time() . '.' . $extension; // renameing image
                    Input::file('signFile')->move($destinationPath, $fileName);
                    $profile_image = url($destinationPath.'/'.$fileName);
                    $profilepic['user_avatar'] = $fileName;
					$forgotData = DB::table('tbl_users')->where('user_id',$session_jobseeker_id)->update($profilepic);
                    return response()->json(['success' => true, 'profileImage' => $profile_image, 'msg'=>'Profile has been updated successfully'], 200);
                }    
            }
        } catch (Exception $e) {
        	Log::error('Problem in update profile picture' . $ex->getMessage());
        }
	}
	
}
