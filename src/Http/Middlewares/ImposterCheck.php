<?php

namespace Fintech\Core\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ImposterCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next (Request): (Response) $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->filled(['password', 'pin']),
            Response::HTTP_FORBIDDEN,
            'This action required user confirmation.');

        $credentials['field'] = ($request->filled(['password']))
            ? 'password'
            : 'pin';

        $credentials['value'] = $request->input($credentials['field']);

        $user = $request->user();

        abort_unless(Hash::check($credentials['value'],$user->{$credentials['field']}),
        Response::HTTP_UNAUTHORIZED,
        "Invalid {$credentials['field']}."
        );

        return $next($request);
    }
}
