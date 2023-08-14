<?php

namespace App\Http\Middleware;

use App\Models\SessionKeyModel;
use Closure;
use Illuminate\Http\Request;

class Auth {
    public function handle(Request $request, Closure $next) {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);
        if(strpos($request->path(), 'control') !== false && empty($userSession)){
            return redirect('login');
        }


        $isLogin = !empty($userSession);

        view()->share('userSession', $userSession);
        view()->share('isLogin', $isLogin);

        return $next($request);
    }
}
