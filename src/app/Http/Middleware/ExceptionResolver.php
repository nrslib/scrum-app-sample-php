<?php


namespace App\Http\Middleware;

use Basic\Exception\NotFoundException;
use Closure;
use Illuminate\Http\Request;

class ExceptionResolver
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (!empty($response->exception)) {
            if ($response->exception instanceof NotFoundException){
                return response(view("notfound"));
            }
        }

        return $response;
    }
}
