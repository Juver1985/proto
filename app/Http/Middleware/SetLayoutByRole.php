<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SetLayoutByRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $layout = match (auth()->user()->role) {
                'admin' => 'layouts.master',
                'mayordomo' => 'layouts.mastermayordomo',
                'trabajador' => 'layouts.mastertrabajador',
                default => 'layouts.master',
            };

            // Comparte la variable con todas las vistas
            View::share('layout', $layout);
        }

        return $next($request);
    }
}

