<?php

namespace App\Models\Jobseeker;
use Illuminate\Database\Eloquent\Model;


class Register extends Model
{
	protected $table = "tbl_users";
	const CREATED_AT = 'user_created_date ';
    const UPDATED_AT = 'user_updated_date';
    protected  $fillable = ['user_password'];
	public function __construct() {
        error_reporting(0);
    }

	 
}
