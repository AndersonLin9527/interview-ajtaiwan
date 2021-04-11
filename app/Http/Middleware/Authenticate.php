<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param \Illuminate\Http\Request $request
   * @return string|null
   * @author Anderson 2021-04-11
   */
  protected function redirectTo($request)
  {
//    Laravel Default
//    if (!$request->expectsJson()) {
//      return route('login');
//    }
    // 此段移到 app/Exceptions/Handler::unauthenticated() 集中處理
    return null;
  }
}
