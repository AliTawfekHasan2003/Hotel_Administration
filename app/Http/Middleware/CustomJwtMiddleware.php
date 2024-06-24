<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\returnSelf;

class CustomJwtMiddleware
{ 
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   try {
        $user = JWTAuth::parseToken()->authenticate();
    }

    catch(TokenExpiredException $e){
    return $this->ReturnError("Token is expired",401);
    }

    catch(TokenInvalidException $e){
    return $this->ReturnError("Token is invalid",401);
    }

    catch(JWTException){
        return $this->ReturnError("Token is not provided",401);
    }

        return $next($request);
    }
}
