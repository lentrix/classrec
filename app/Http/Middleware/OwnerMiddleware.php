<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OwnerMiddleware
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

        $myClass = $request->route('myClass');

        if($myClass) {
            if($myClass->user_id==auth()->user()->id) {
                return $next($request);
            }else {
                return redirect()->back()->with('Error','You are not the owner of this class.');
            }
        }else {
            throw new BadRequestHttpException(500);
        }
    }
}
