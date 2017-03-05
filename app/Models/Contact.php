<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Contact extends Model {

    /**
     * Generated
     */

    protected $table = 'contact';
    protected $fillable = ['id', 'firstName', 'lastName', 'phone1', 'created_at','updated_at','userId'];


    public function account() {
        return $this->belongsTo(\App\Models\Account::class, 'accountId', 'id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'userId', 'id');
    }


    public static function dataOperation($request) {
        if($request->method() == 'GET'){
            if($request->id){
                return Contact::find($request->id);
            }else{
                return Contact::all();
            }
        }
        if($request->method() == 'POST'){
            Contact::validator($request->all())->validate();
            if($request->id){
                $Contact = Contact::find($request->id);
                return $Contact->update($request->all());
            }else{
                $Contact = new Contact();
                return $Contact->create(array_merge($request->all(), ['id' => Contact::uniqueValue()]));
            }
        }
    }

    public static function uniqueValue() {
        return md5(date("Y/m/d") . date('m/d/Y h:i:s a', time()) . uniqid());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $request
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected static function validator($request) {
                return Validator::make(
                                $request, [
                            'firstName' => 'required|max:50',
                            'accountId' => 'required',
                ]);
    }
}
