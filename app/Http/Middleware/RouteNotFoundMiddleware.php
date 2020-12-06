<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RouteNotFoundMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route()->getName() === "admin.stores.show") {
            flash('Rota não encontrada...')->warning();
            return redirect()->route('admin.stores.index');
        }

        return $next($request);
    }
}
