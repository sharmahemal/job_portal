<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerUser extends Model
{
	public $table = 'tbl_emp_user';
	public $primaryKey = 'company_id';
	
	public function getAvatar()
	{
		if ( $this->company_avatar ) {
			$url = url('public/uploads/employer/' . $this->company_id . '/' . $this->company_avatar);
		} else {
			$url = url('public/img/company-building-icon.png');
		}
		
		return $url;
	}
	
	public function slug()
	{
		if ( $this->company_alias ) {
			return $this->company_alias;
		} else {
			return $this->company_id;
		}
	}
	
	public function country()
	{
		return $this->belongsTo('App\Models\Country', 'company_country_id', 'country_id');
	}
	
	public function companySize()
	{
		return $this->belongsTo('App\Models\CompanySize', 'company_size_id', 'id');
	}
	
	public function state()
	{
		return $this->belongsTo('App\Models\State', 'company_state_id', 'state_id');
	}
	
	public function industry()
	{
		return $this->hasOne('App\Models\Industry', 'id', 'company_industry_id');
	}
	
	public function posts()
	{
		return $this->hasMany('App\Models\JobPost', 'post_created_id', 'company_id');
	}
}