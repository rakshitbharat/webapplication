<?php

namespace Modules\SidbarBuilder\Http\Controllers;

use view;
use Illuminate\Routing\Controller;
use App\Models\SidbarBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;

class SidbarBuilderController extends Controller {

    public $title = 'SidbarBuilder';

    public function routeName() {
        $routeCollection = Route::getRoutes();
        $sidebarRoute = array();
        foreach ($routeCollection as $value) {
            if ($value->middleware()) {
                if ($value->middleware()[0] == 'adminAuth') {
                    if (strpos($value->getName(), 'mainRoute') !== false) {
                        $sidebarRoute['mainRoute'][] = $value->getName();
                    }
                    if (strpos($value->getName(), 'subRoute') !== false) {
                        $sidebarRoute['subRoute'][] = $value->getName();
                    }
                }
            }
        }
        return $sidebarRoute;
    }

}
