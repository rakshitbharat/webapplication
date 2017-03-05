<?php

namespace Modules\AdminModule\Http\Controllers;

use view;
use Illuminate\Routing\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class ContactController extends Controller {

    public $title = 'Contact';

    public function index() {
        return view('adminmodule::Contact.list', array('title' => $this->title));
    }

    public function json() {
        $all_category = Contact::select('*');
        return Datatables::of($all_category)
                        ->addIndexColumn()
                        ->addColumn('action', function ($data) {
                            $tableName = 'contact';
                            $string = "<a href='javascript:;' onclick=edit('$data->id','$tableName') class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a>"
                                    . "<a href='javascript:;' onclick=destroyFinally('$data->id','$tableName') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
                            return $string;
                        })
                        ->make(true);
    }

    public function addEdit(Request $request) {
        $Contact = Contact::dataOperation($request);
        return response()->json(['data' => $Contact]);
    }
}
