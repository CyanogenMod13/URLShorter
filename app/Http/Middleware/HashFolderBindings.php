<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HashFolderBindings
{
    public function handle(Request $request, Closure $next)
    {
		$newParams = [];
		$route = $request->route();
		if ($route->hasParameter('param2')) {
			$newParams['hash'] = $route->parameter('param2');
			$newParams['folder'] = $route->parameter('param1');
		} else {
			$newParams['hash'] = $route->parameter('param1');
		}
		$route->parameters = $newParams;
        return $next($request);
    }
}
