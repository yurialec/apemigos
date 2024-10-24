<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AclMiddleware
{
    protected $except = [
        'profile',
        'profile.view',
        'modules.list',
    ];

    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();

        if (in_array($routeName, $this->except) || str_contains($routeName, 'index') || str_contains($routeName, 'update') || str_contains($routeName, 'store')) {
            return $next($request);
        }

        $permissions = $request->user()->role->permissions->pluck('name')->toArray();

        if (!in_array($routeName, $permissions) and $request->user()->role->name != 'Desenvolvedor') {
            return redirect()
                ->route('home')
                ->withErrors([
                    'message' => 'Você não tem permissão para acessar essa funcionalidade'
                ]);
        }

        return $next($request);
    }
}
