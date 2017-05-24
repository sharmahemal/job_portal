<?php

namespace App\Http\Controllers\Employer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employer\Post;
use Illuminate\Support\Facades\Validator;
use App\Traits\CommonTrait;
use App\Models\EmployerUser as Company;
use Session;
use DB;
use Response;
use Mail;
use Hash;

class ProfileController extends Controller
{
	use CommonTrait;
	
	public function index(Request $request, $slug)
	{
		if ( intval($slug) ) {
			$company = Company::findOrFail($slug);
		} else {
			$company = Company::where('company_alias', $slug)->firstOrFail();
		}
		
		return view('employer.companyProfile', [
			'company' => $company
		]);
	}
}