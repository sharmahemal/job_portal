<?php

namespace App\Http\Middleware;
use App\Traits\CommonTrait;
use Session;
use Closure;

class IsEmployerMiddleware
{
	use CommonTrait;
	public function __construct() {
        error_reporting(0);
        
    }
    public function handle($request, Closure $next)
    {
		if(!Session::has('employer_id'))
		{
			return redirect()->route('employer.home');
		}
		return $next($request);
	}
		
}
