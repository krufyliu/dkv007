<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth:web');
        $route = Route::currentRouteAction();
        list($controller, $action) = explode('@', $route);

        // 取得Controller 的名字，不包含 namespace.
        $controller_name = substr($controller, strrpos($controller, "\\") + 1);

        View::share('controller', $controller_name );
        View::share('action', $action);
        View::share('input', Input::all());
    }
}
