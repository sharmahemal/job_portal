<?php

namespace App\Models\Employer;
use Illuminate\Database\Eloquent\Model;


class Register extends Model
{
	protected $table = "tbl_users";
	public function __construct() {
        error_reporting(0);
    }

	 
}
