<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class AccessOperation
{
    public function handle(Request $request, Closure $next): Response
    {
        $log = new Logger('AccessOperation');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../../app/storage/logs/access.log'));

        $log->info($request->fullUrlWithQuery);

        return $next($request);
    }
}
