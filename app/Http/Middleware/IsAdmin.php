<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Symfony\Component\HttpFoundation\Response;

    class IsAdmin
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
         */
        public function handle(Request $request, Closure $next): Response
        {
            // Periksa apakah user sudah login dan memiliki role 'admin'
            if (Auth::check() && Auth::user()->role === 'admin') {
                return $next($request);
            }

            // Jika tidak, kembalikan response 403 Forbidden (Unauthorized)
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }
    