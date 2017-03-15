<?php

namespace Modules\FrontModule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Contactus;
use Validator;

class FrontMainController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        return view('frontmodule::dashboard');
        ;
    }

    public function contactUsSave(Request $request) {
        $this->validator($request->all())->validate();
        $Contactus = Contactus::create($request->all());
        $message = 'Inquiry submitted';
        Session()->flash('success', $message);
        return redirect()->route('front_home');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $id = '') {

        return Validator::make(
                        $data, [
                    'name' => 'required',
                    'email' => 'required',
        ]);
    }

    public function articleFormSave(Request $request) {

        $validator = Validator::make(
                        $request->all(), [
                    'af_name' => 'required',
                    'af_areaCode' => 'required',
                    'af_contact' => 'required',
                    'af_message' => 'required'
        ]);

        if (!$validator->fails()) {
            //$SaveData = save($request->all());
            $SaveData = \DB::table('articleform')->insert($request->all());
            return response()->json(['success' => 'success', 'data' => $SaveData]);
        } else {
            //$validator;
            return response()->json(['success' => 'error', 'data' => $validator]);
        }
    }

}
