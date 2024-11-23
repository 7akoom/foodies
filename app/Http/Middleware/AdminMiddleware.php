<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\RespondService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    protected $respond;

    public function __construct(RespondService $respond) {
        $this->respond = $respond;
    }
    
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            return $this->respond->respondRedirect('admin.login','error','Access denied, You must login');
        }
        return $next($request);
    }
}
