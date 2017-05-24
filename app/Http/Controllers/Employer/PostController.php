<?php

namespace App\Http\Controllers\Employer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employer\Post;
use Illuminate\Support\Facades\Validator;
use App\Traits\CommonTrait;
use Session;
use DB;
use Response;
use Mail;
use Hash;

class PostController extends Controller
{
	use CommonTrait;
	public function __construct() {
        error_reporting(0);
    }
	
	public function index()
	{
		$employerID = $this->getEmployerID();
		$getPost = DB::table('tbl_comp_post')->where('post_created_id', $employerID)->paginate(20);
		$data['post_data'] = $getPost;
		return view('employer.post-list',$data);
	}
	public function postAdd()
	{	
		$data['country'] = $this->getCountry();
        $data['state'] = $this->getState();
        return view('employer.post-add',$data);
	}
	
	public function postEdit(Request $request, $id)
	{
		$post = \App\Models\JobPost::findOrFail($id);
		
		return view('employer.post-edit', [
			'post' => $post
		]);
	}
	
	public function postUpdate(Request $request, $id)
	{
		$post = \App\Models\JobPost::findOrFail($id);
		
		$post->post_title = $request->input('post_title');
		$post->post_type = $request->input('post_type');
		$post->post_category = $request->input('post_category');
		$post->post_level = $request->input('post_level');
		$post->post_position = $request->input('post_position');
		$post->post_country = $request->input('post_country');
		$post->post_state = $request->input('post_state');
		$post->post_city = $request->input('post_city');
		$post->post_address = $request->input('post_address');
		$post->post_postalcode = $request->input('post_postalcode');
		$post->post_salry = $request->input('post_salry');
		$post->post_department = $request->input('post_department');
		$post->post_email_alert = $request->input('post_email_alert');
		$post->post_lat = $request->input('post_lat');
		$post->post_long = $request->input('post_long');		
		$post->post_tech_skill = implode(',', $request->input('post_tech_skill'));
		$post->post_tech_experience = implode(',', $request->input('post_tech_experience'));
		$post->post_soft_skill = implode(',', $request->input('post_soft_skill'));
		$post->post_soft_experience = implode(',', $request->input('post_soft_experience'));
		$post->post_languages = implode(',', $request->input('post_languages'));
		$post->post_languages_spoken = implode(',', $request->input('post_languages_spoken'));
		$post->post_languages_written = implode(',', $request->input('post_languages_written'));
		$post->post_education = implode(',', $request->input('post_education'));
		$post->post_course = implode(',', $request->input('post_course'));
		
		$post->save();
		
		Session::put('success','Your post has been updated.');
		return redirect('employer/post/' . $id);
	}

	public function postStore(Request $request)
	{
		$employerID = $this->getEmployerID();
		$_POST['post_tech_skill'] = implode(',', $_POST['post_tech_skill']);
		$_POST['post_tech_experience'] = implode(',', $_POST['post_tech_experience']);
		$_POST['post_soft_skill'] = implode(',', $_POST['post_soft_skill']);
		$_POST['post_soft_experience'] = implode(',', $_POST['post_soft_experience']);
		$_POST['post_languages'] = implode(',', $_POST['post_languages']);
		$_POST['post_languages_spoken'] = implode(',', $_POST['post_languages_spoken']);
		$_POST['post_languages_written'] = implode(',', $_POST['post_languages_written']);
		$_POST['post_education'] = implode(',', $_POST['post_education']);
		$_POST['post_course'] = implode(',', $_POST['post_course']);
		$_POST['post_status'] = 'Inactive';
		$_POST['post_created_id'] = $employerID;
		$_POST['post_created_date'] = config('app.date');
		
		$salary = explode('-', $_POST['post_salry']);
		
		$min = intval($salary[0]);
		$max = intval($salary[1]);
		
		if ( !$min ) {
			$_POST['post_salary_min'] = null;
		} else {
			$_POST['post_salary_min'] = $min;
		}
		
		if ( !$max ) {
			$_POST['post_salary_max'] = null;
		} else {
			$_POST['post_salary_max'] = $max;
		}
		
		unset($_POST['_token']);
		unset($_POST['btn_submit']);
		$insertData = DB::table('tbl_comp_post')->insert($_POST);
		Session::put('success','Your post has been added successfully');
		return redirect()->route('employer.post.list');
	}
	
	
	public function postStatus(Request $request, $id) {
		$employerID = $this->getEmployerID();
		$getPost = DB::table('tbl_comp_post')->where('id', $id)->first();
		$post_status = $getPost->post_status;
		($post_status =='Active')? $post_status = 'Inactive' : $post_status = 'Active';
		DB::table('tbl_comp_post')->where('id', '=', $id)->update(['post_status' => $post_status]);
		Session::put('success','Your post status has been changed successfully');
		return redirect()->route('employer.post.list');
	}
	
}
