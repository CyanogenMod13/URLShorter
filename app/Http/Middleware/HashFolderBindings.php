<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HashFolderBindings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		$route = $request->route();
		if ($route->hasParameter('param2')) {
			$newParams = [
				'hash' => $route->parameter('param2'),
				'folder' => $route->parameter('param1')
			];
			$route->parameters = $newParams;
		}
        return $next($request);
    }
}
