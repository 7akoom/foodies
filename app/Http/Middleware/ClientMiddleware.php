<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\RespondService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    protected $respond;

    public function __construct(RespondService $respond) {
        $this->respond = $respond;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('client')->check()) {
            return $this->respond->respondRedirect('client.login','error','Access denied, You must login');
        }
        return $next($request);
    }
}
