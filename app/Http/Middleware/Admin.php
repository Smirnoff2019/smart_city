<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $this->isAdmin();
        return $next($request);
    }

    /**
     * @return $this|RedirectResponse
     */
    public function isAdmin() {

        $isAuth = Auth::check();

        $hasAccesseToAdminPanel = Gate::check('access-to-admin-panel');

        if ( $isAuth && !$hasAccesseToAdminPanel ) {

            Auth::logout();

            return redirect()->route('login')->withErrors(['access' => 'Вам отказано в доступе!']);
        }

        return $this;
        //return $next($request);
    }
}
