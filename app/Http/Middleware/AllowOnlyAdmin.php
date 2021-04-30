<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Support\Facades\Auth;
    

    class AllowOnlyAdmin
    {
        public function handle($request, Closure $next)
        {
            
            if (Auth::user()->hasRole('Admin')) {
                return $next($request);
            }

            abort(403);
            // echo Auth::user()->hasRole('Admin');
            // return $next($request);
        }
    }

    // $roles = Role::pluck('name','name')->all();
    // $userRole = $user->roles->pluck('name','name')->all();