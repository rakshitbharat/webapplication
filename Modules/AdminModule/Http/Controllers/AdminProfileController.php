<?php

namespace Modules\AdminModule\Http\Controllers;

use view;
use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Image;
use Illuminate\Support\Facades\Auth;
use Hash;
use Response;

class AdminProfileController extends Controller {

    public $title = 'My Profile';

    public function index() {
        return view('adminmodule::AdminProfile.index');
    }

    public function save(Request $request) {
        $validate = $this->validator($request->all(), Auth::User()->id, $request->password)->validate();
        $user = User::find(Auth::User()->id);
        $user->name = $request->name;
        $user->save();
        $message = 'Profile updated sucessfully.';
        return response()->json(['data' => $user, 'success' => $message]);
    }

    public function changepassword(Request $request) {
        $rules = [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed|different:old_password',
            'password_confirmation' => 'required|min:8|required_with:password|min:5',
        ];
        $this->validate($request, $rules);
        $auth = User::where('email', Auth::user()->email)
                ->first();
        if (Hash::check($request->old_password, $auth->password)) {
            $auth = User::find(Auth::user()->id);
            $auth->password = bcrypt($request->password);
            $auth->save();
            return response()->json(['success' => "Password has been changed successfully."], 200);
        } else {
            return response()->json(['old_password' => ['Old password was wrong']], 422);
        }
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
                            'old_password' => 'required',
                            'password' => 'required|min:8|confirmed|different:old_password',
                            'password_confirmation' => 'required|min:8|required_with:password',
                ]);
            } else {
                return Validator::make(
                                $data, [
                            'name' => 'required|max:255',
                ]);
            }
        } else {
            return Validator::make(
                            $data, [
                        'name' => 'required|max:255',
            ]);
        }
    }

}
