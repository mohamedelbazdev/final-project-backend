<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use ApiResponseTrait;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * @param $request
     * @param array $guards
     * @return void
     */
    protected function unauthenticated($request, array $guards)
    {
        abort($this->apiResponse('Unauthenticated',null, 401, 'not allow'));
    }
}
