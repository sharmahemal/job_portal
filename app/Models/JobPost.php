<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobPost extends Model
{
	public $table = 'tbl_comp_post';
	
	public $timestamps = false;
	
	public function getSalaryText()
	{
		$min = $this->post_salary_min;
		$max = $this->post_salary_max;
		$text = '';
		
		if ( $min && $max ) {
			$text = 'RM' . number_format($min) . ' - RM' . number_format($max);
		} else if ( !$min ) {
			$text = 'Less than RM' . number_format($max);
		} else {
			$text = 'More than RM' . number_format($min);
		}
		
		return $text;
	}
	
	public function getLocation()
	{
		$text = '';
		$text .= $this->post_address . ', ' . $this->post_postalcode . ', ' . $this->post_city . ', ' .$this->post_state . ', ' . $this->post_country;
		
		return $text;
	}
	
	public function isBookmarked()
	{
		$jobseekerId = session('jobsekker_id');
		
		if ( $jobseekerId ) {
			$row = DB::table('tbl_bookmarks')->where([
				['user_id', $jobseekerId],
				['post_id', $this->id]
			])->get();
			
			if ( $row->count() ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function employerUser()
	{
		return $this->belongsTo('App\Models\EmployerUser', 'post_created_id', 'company_id');
	}
	
	public function jobseekers()
	{
		return $this->belongsToMany('App\Models\Jobseeker', 'tbl_user_post', 'post_id', 'id')->withPivot('resume_id', 'salary');
	}
}