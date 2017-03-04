<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class AccountType extends Model {

    /**
     * Generated
     */
    protected $table = 'accountType';
    protected $fillable = ['id', 'name', 'userId'];

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'userId', 'id');
    }

    public function accounts() {
        return $this->hasMany(\App\Models\Account::class, 'accountTypeId', 'id');
    }

    public static function dataOperation($request) {
        if ($request->method() == 'GET') {
            if ($request->id) {
                return AccountType::find($request->id);
            } else {
                return AccountType::all();
            }
        }
        if ($request->method() == 'POST') {
            AccountType::validator($request->all())->validate();
            if ($request->id) {
                $AccountType = AccountType::find($request->id);
                return $AccountType->update($request->all());
            } else {
                $AccountType = new AccountType();
                return $AccountType->create($request->all());
            }
        }
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
                    'name' => 'required|max:255',
        ]);
    }

}
