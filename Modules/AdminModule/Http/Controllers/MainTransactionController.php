<?php

namespace Modules\AdminModule\Http\Controllers;

use view;
use Illuminate\Routing\Controller;
use App\Models\MainTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class MainTransactionController extends Controller {

    public $title = 'Main Transaction';

    public function index() {
        return view('adminmodule::MainTransaction.list', array('title' => $this->title));
    }

    public function json() {
        $all_category = MainTransaction::selectRaw('*, sum(debit) as sumDebit, sum(credit) as sumCredit')->groupBy('mainTransaction.transactionCode');
        return Datatables::of($all_category)
                        ->addIndexColumn()
                        ->addColumn('action', function ($data) {
                            $tableName = 'mainTransaction';
                            $string = "<a href='javascript:;' onclick=edit('$data->transactionCode','$tableName') class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a>"
                                    . "<a href='javascript:;' onclick=mainTransactionDeleteByTransactionCode('$data->transactionCode') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
                            return $string;
                        })
                        ->make(true);
    }

    public function addEdit(Request $request) {
        $MainTransaction = MainTransaction::dataOperation($request);
        return response()->json(['data' => $MainTransaction]);
    }

    public function transactionGroupEdit(Request $request) {
        $mainTransaction = MainTransaction::where('transactionCode', '=', $request->transactionCode)->get();
        return view('adminmodule::MainTransaction.debitcreditEdit', array('mainTransaction' => $mainTransaction));
    }

    public function deleteByTransactionCode(Request $request) {
        return MainTransaction::where('transactionCode', '=', $request->transactionCode)->delete();
    }

}
