<?php

namespace Modules\AdminModule\Http\Controllers;

use view;
use Illuminate\Routing\Controller;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class AccountTypeController extends Controller {

    public $title = 'Account Type';

    public function index() {
        return view('adminmodule::AccountType.list', array('title' => $this->title));
    }

    public function json() {
        $all_category = AccountType::select('*');
        return Datatables::of($all_category)
                        ->addIndexColumn()
                        ->addColumn('action', function ($data) {
                            $tableName = 'accountType';
                            $string = "<a href='javascript:;' onclick=edit('$data->id','$tableName') class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a>"
                                    . "<a href='javascript:;' onclick=destroyFinally('$data->id','$tableName') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
                            return $string;
                        })
                        ->make(true);
    }

    public function addEdit(Request $request) {
        $AccountType = AccountType::dataOperation($request);
        return response()->json(['data' => $AccountType]);
    }
}
