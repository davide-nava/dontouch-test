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
        $log = new Logger('AccessOperation');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../../app/storage/logs/access.log'));

        $log->info($request->url());

        return $next($request);
    }
}
