<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

class SettingController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        return view('adminmodule::Setting.index');
    }
}
