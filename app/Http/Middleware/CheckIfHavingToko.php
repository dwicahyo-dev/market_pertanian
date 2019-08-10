<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;
use Illuminate\Support\Facades\Auth;

class CheckIfHavingToko
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
        $store = Auth::user()->store;

        if ($store) return redirect()->route('stores.show', $store->id);

        return $next($request);
    }
}
