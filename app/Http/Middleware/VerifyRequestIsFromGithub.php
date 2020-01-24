<?php

namespace App\Http\Middleware;

use App\GithubSignature;
use Closure;

class VerifyRequestIsFromGithub
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
        $signature = GithubSignature::make($request->getContent());

        abort_unless(hash_equals($signature, (string) $request->header('x-hub-signature')), 401, 'Invalid GitHub signature.');

        return $next($request);
    }
}
