<?php

namespace Modules\Location\Http\Controllers;

use view;
use Illuminate\Routing\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class LocationController extends Controller {

    public $title = 'Location';

    public function index() 
	{
        return view('location::index', array('title' => $this->title));
    }

}
