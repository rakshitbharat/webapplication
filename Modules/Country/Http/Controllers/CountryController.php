<?php

namespace Modules\Country\Http\Controllers;

use view;
use Illuminate\Routing\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class CountryController extends Controller {

    public $title = 'Country';

    public function index() 
	{
        return view('country::index', array('title' => $this->title));
    }

}
