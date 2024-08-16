<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;

class AccessOperation
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = dirname(__DIR__, 1) . '\storage\logs\access.log';
        $log = new Logger('AccessOperation');
        $log->pushHandler(new StreamHandler($path));

        $log->info($request->url());

        return $next($request);
    }
}
