<?php

namespace Modules\AdminModule\Http\Controllers;

use view;
use Illuminate\Routing\Controller;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class AccountTypeController extends Controller {

    public $title = 'Chart of Account';

    public function index() {
        return view('adminmodule::AccountType.list', array('title' => $this->title));
    }

    public function json() {
        $all_category = AccountType::leftJoin('users', 'users.id', '=', 'accountType.userId')->select('accountType.id','accountType.name','users.email');
        return Datatables::of($all_category)
                        ->addIndexColumn()
                        ->addColumn('action', function ($data) {
                            $tableName = 'accountType';
                            $string = "<a href='javascript:;' onclick=edit('$data->id','$tableName') class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a>"
                                    . "<a href='javascript:;' onclick=destroyFinally('$data->id','$tableName') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
                            return $string;
                        })
                        ->make(true);

        $all_item = Item::leftJoin('category', 'category.id', '=', 'items.category_id')
                ->with('category')->whereNull('items.deleted_at')
                ->select('items.id', 'items.item_name', 'items.price', 'items.status', 'category.category_name')
        ;
        return Datatables::of($all_item)
                        ->addColumn('action', function ($item) {
                            $delete_route = $item->id;
                            $item_name = $item->item_name;
                            $edit_route = route('editItem', ['id' => $item->id]);
                            $buttons = view('item::partials.buttons', compact('delete_route', 'edit_route', 'item_name'))->render();
                            return $buttons;
                        })
                        ->editColumn('status', function ($item) {
                            $checked = $item->status ? "checked" : "";
                            $status = '<input type="checkbox" class="bootstrapSwitch"  data-on="Enabled" data-off="Disabled" data-toggle="toggle" data-id="' . $item->id . '"  data-size="mini" data-onstyle="success" data-offstyle="danger" ' . $checked . '>';

                            return $status;
                        })
                        ->make(true);
    }

    public function addEdit(Request $request) {
        $AccountType = AccountType::dataOperation($request);
        return response()->json(['data' => $AccountType]);
    }

}
