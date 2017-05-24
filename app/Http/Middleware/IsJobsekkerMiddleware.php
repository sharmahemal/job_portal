<?php

namespace App\Http\Middleware;
use App\Traits\CommonTrait;
use Session;
use Closure;

class IsJobsekkerMiddleware
{
	use CommonTrait;
	public function __construct() {
        error_reporting(0);
        
    }
    public function handle($request, Closure $next)
    {
		if(!Session::has('jobsekker_id'))
		{
			return redirect()->route('jobsekker.dashboard');
		}
		return $next($request);
	}
		
}
