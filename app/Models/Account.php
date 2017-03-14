<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Auth;
use DB;

class Account extends Model {

    /**
     * Generated
     */
    protected $table = 'account';
    protected $fillable = ['name', 'accountTypeId', 'userId', 'openingBalance', 'currentBalance'];

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

    public static function concatNameCurrentBalance() {
        return Account::selectRaw("concat(name,' ',SUM( COALESCE( currentBalance, 0 ) + COALESCE( openingBalance, 0 )),'Rs') AS concatNameCurrentBalance,id")->get()->toArray();
    }

    public static function currentBalanceByaccountId($id) {
        return Account::selectRaw("SUM( COALESCE( currentBalance, 0 ) + COALESCE( openingBalance, 0 )) as currentBalanceNew")->where('id', '=', $id)->get();
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
                return $Account->update(array_merge($request->all(), ['userId' => Auth::user()->id]));
            } else {
                $Account = new Account();
                return $Account->create(array_merge($request->all(), ['userId' => Auth::user()->id]));
            }
        }
    }

    public static function syncCurrentBalance() {
        $getCurrentBalance = 'SELECT SUM(COALESCE(credit, 0) - COALESCE(debit, 0)) AS currentBalance,accountId FROM `mainTransaction` GROUP BY accountId';
        $getCurrentBalance = DB::select($getCurrentBalance);
        foreach ($getCurrentBalance as $getCurrentBalances) {
            $Account = Account::find($getCurrentBalances->accountId);
            $Account->currentBalance = $getCurrentBalances->currentBalance;
            $Account->save();
        }
        echo 'Current Balance synced';
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
                    'accountTypeId' => 'required',
        ]);
    }

}
