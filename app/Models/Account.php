<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Account extends Model {

    /**
     * Generated
     */

    protected $table = 'account';
    protected $fillable = ['name', 'accountTypeId', 'userId'];


    public function accountType() {
        return $this->belongsTo(\App\Models\Account::class, 'accountTypeId', 'id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'userId', 'id');
    }

    public function users() {
        return $this->belongsToMany(\App\Models\User::class, 'mainTransaction', 'accountId', 'userId');
    }

    public function mainTransactions() {
        return $this->hasMany(\App\Models\MainTransaction::class, 'accountId', 'id');
    }

    public static function dataOperation($request) {
        if ($request->method() == 'GET') {
            if ($request->id) {
                return Account::find($request->id);
            } else {
                return Account::all();
            }
        }
        if ($request->method() == 'POST') {
            Account::validator($request->all())->validate();
            if ($request->id) {
                $Account = Account::find($request->id);
                return $Account->update($request->all());
            } else {
                $Account = new Account();
                return $Account->create($request->all());
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
