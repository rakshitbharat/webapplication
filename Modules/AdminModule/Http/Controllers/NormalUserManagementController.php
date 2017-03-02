<?php

namespace Modules\AdminModule\Http\Controllers;

use view;
use Illuminate\Routing\Controller;
use App\DataTables\NormalUserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Image;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class NormalUserManagementController extends Controller {

    public $title = 'Customer';

    public function index() {
        return view('adminmodule::NormalUser.list', array('title' => $this->title));
    }

    public function json() {
        $all_category = User::where('role', '!=', 'admin')->select('*')->orderBy('id', 'desc');
        return Datatables::of($all_category)
                        ->addIndexColumn()
                        ->editColumn('locked', function ($data) {
                            if ($data->locked == true) {
                                $string = "<a href='javascript:;' onclick=userLocking('$data->id','$data->locked') class='btn btn-xs btn-danger'><i class='fa fa-lock' aria-hidden='true'></i></a>";
                            }
                            if ($data->locked == false) {
                                $string = "<a href='javascript:;' onclick=userLocking('$data->id','$data->locked') class='btn btn-xs btn-success'><i class='fa fa-unlock' aria-hidden='true'></i></a>";
                            }
                            return $string;
                        })
                        ->addColumn('action', function ($data) {
                            $tableName = 'users';
                            $routeForEdit = route('admin_normalusermanagement.edit', array('id' => $data->id));
                            $string = "<a href='$routeForEdit' class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a>"
                                    . "<a href='javascript:;' onclick=destroyFinally('$data->id','$tableName') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
                            return $string;
                        })
                        ->make(true);
    }

    public function create() {
        $User = User::all();
        return view('adminmodule::NormalUser.add', array(
            'title' => $this->title,
            'User' => $User
        ));
    }

    public function edit($id) {
        $user = User::find($id);
        return view('adminmodule::NormalUser.edit', array(
            'title' => $this->title, 'user' => $user));
    }

    public function store(Request $request) {
        $validate = $this->validator($request->all())->validate();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->confirmed = $request->confirmed;
        $user->role = $request->role;
        $user->save();
        $message = 'User has been added';
        $request->session()->flash('success', $message);
        return response()->json(['data' => $user, 'success' => $message]);
    }

    public function update($id, Request $request) {
        $validate = $this->validator($request->all(), $id, $request->password)->validate();
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->confirmed = $request->confirmed;
        $user->role = $request->role;
        $user->save();
        $message = 'User has been updated';
        $request->session()->flash('success', $message);
        return response()->json(['data' => $user, 'success' => $message]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $id = '', $password = '') {
        if ($id) {
            if ($password) {
                return Validator::make(
                                $data, [
                            'name' => 'required|max:255',
                            'email' => 'required|email|unique:App\User,email,' . $id . '',
                            'password' => 'required|min:8|confirmed',
                            'role' => 'required',
                ]);
            } else {
                return Validator::make(
                                $data, [
                            'name' => 'required|max:255',
                            'email' => 'required|email|unique:App\User,email,' . $id . '',
                            'role' => 'required',
                ]);
            }
        } else {
            return Validator::make(
                            $data, [
                        'name' => 'required|max:255',
                        'email' => 'required|email|unique:App\User,email',
                        'password' => 'required|min:8|confirmed',
                        'role' => 'required',
            ]);
        }
    }

    public function uniqueValue() {
        return md5(date("Y/m/d") . date('m/d/Y h:i:s a', time()) . uniqid());
    }

}
