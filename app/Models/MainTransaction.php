<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class MainTransaction extends Model {

    /**
     * Generated
     */
    protected $table = 'mainTransaction';
    protected $fillable = ['description', 'debit', 'credit', 'accountId', 'userId', 'transactionCode'];

    public function account() {
        return $this->belongsTo(\App\Models\Account::class, 'accountId', 'id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'userId', 'id');
    }

    public static function dataOperation($request) {
        if ($request->method() == 'GET') {
            if ($request->id) {
                return MainTransaction::find($request->id);
            } else {
                return MainTransaction::all();
            }
        }
        if ($request->method() == 'POST') {
//            MainTransaction::validator($request->all())->validate();
            if ($request->id) {
                $MainTransaction = MainTransaction::find($request->id);
                return $MainTransaction->update($request->all());
            } else {
                $MainTransaction = new MainTransaction();
                $uniqueValue = MainTransaction::uniqueValue();
                foreach ($request->all() as $key => $requestInPart) {
                    if (array_key_exists('debit', $requestInPart)) {
                        $MainTransaction->create(array_merge($requestInPart['debit'], ['transactionCode' => $uniqueValue]));
                    }
                    if (array_key_exists('credit', $requestInPart)) {
                        $MainTransaction->create(array_merge($requestInPart['credit'], ['transactionCode' => $uniqueValue]));
                    }
                }
                exit;
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
                    'description' => 'required|max:255',
                    'accountId' => 'required',
        ]);
    }

}
