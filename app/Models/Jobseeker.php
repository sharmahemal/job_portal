<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobseeker extends Model
{
	public $table = 'tbl_users';
	public $primaryKey = 'user_id';
	
	public function posts()
	{
		return $this->belongsToMany('App\Models\JobPost', 'tbl_user_post', 'user_id', 'user_id')->withPivot('resume_id', 'salary');
	}
	
	public function resumes()
	{
		return $this->hasMany('App\Models\Resume', 'user_id', 'user_id');
	}
}