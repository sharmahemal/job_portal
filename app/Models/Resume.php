<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
	public $table = 'tbl_resumes';
	
	public function link()
	{
		$link = 'public/uploads/jobseeker/' . $this->user_id . '/' . $this->filename;
		return url($link);
	}
}