<?php

namespace App\Http\Middleware;

use Closure;

class ShouldShowInstall
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->checkIfNotInstalled() && request()->segment(1) != "install"){

            return redirect('/install');
        }
        return $next($request);
    }

    /**
     * If application is not installed.
     *
     * @return bool
     */
    public function checkIfNotInstalled()
    {
        return !file_exists(storage_path('installed'));
    }
}
