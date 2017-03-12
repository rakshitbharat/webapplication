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
        if ($request->method() == 'POST') {
            if (array_key_exists('transactionCode', $request->all())) {
                
            } else {
                $message = array();
                if (empty($request->all())) {
                    $message['error'][] = 'Entry not found at both side';
                }
                $totalEntryDebit = 0;
                $totalEntryCredit = 0;
                $totalDebitAmount = 0;
                $totalCreditAmount = 0;
                $accountId = array();
                foreach ($request->all() as $key => $requestAll) {
                    if (array_key_exists('debit', $requestAll)) {
                        $totalEntryDebit++;
                        if (!$requestAll['debit']['description']) {
                            $message['error'][] = 'Description is empty in debit side';
                        }
                        if (!$requestAll['debit']['accountId']) {
                            $message['error'][] = 'Account is empty in debit side';
                        } else {
                            $accountId[] = $requestAll['debit']['accountId'];
                        }
                        if (!$requestAll['debit']['debit']) {
                            $message['error'][] = 'Amount debit is empty in debit side';
                        } else {
                            $totalDebitAmount += $requestAll['debit']['debit'];
                        }
                    }
                    if (array_key_exists('credit', $requestAll)) {
                        $totalEntryCredit++;
                        if (!$requestAll['credit']['description']) {
                            $message['error'][] = 'Description is empty in credit side';
                        }
                        if (!$requestAll['credit']['accountId']) {
                            $message['error'][] = 'Account is empty in credit side';
                        } else {
                            $accountId[] = $requestAll['credit']['accountId'];
                        }
                        if (!$requestAll['credit']['credit']) {
                            $message['error'][] = 'Amount credit is empty in credit side';
                        } else {
                            $totalCreditAmount += $requestAll['credit']['credit'];
                        }
                    }
                }
                if ($totalEntryDebit < 1) {
                    $message['error'][] = 'Entry not found at debit side';
                }
                if ($totalEntryCredit < 1) {
                    $message['error'][] = 'Entry not found at credit side';
                }
                if ($totalDebitAmount !== $totalCreditAmount) {
                    $message['error'][] = 'Amount should be in balance at both side';
                }
                if (count(array_unique($accountId)) < count($accountId)) {
                    $message['error'][] = 'Amount selection should be unique in both side';
                }
                if (!empty($message)) {
                    return response()->json([$message], 422);
                }
            }
        }
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
