<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySize extends Model
{
	public $table = 'tbl_comp_size';
	
	public function employerUser()
	{
		return $this->hasMany('App\Models\EmployerUser', 'company_size_id');
	}
}