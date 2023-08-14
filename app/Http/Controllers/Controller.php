<?php

namespace App\Http\Controllers;

use App\Models\SessionKeyModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $isLogin = false;

    public $userSession = [];

    public function __construct() {
        $this->userSession = Session::get(SessionKeyModel::USER_LOGIN);
        $this->isLogin = !empty($userSession);

        View::share('userSession', $this->userSession);
        View::share('isLogin', $this->isLogin);
        View::share('test', 'ok');
    }

    public function getUserSession() {
        return Session::get(SessionKeyModel::USER_LOGIN);
    }
}
