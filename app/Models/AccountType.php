<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        if($request->method() == 'GET'){
            if($request->id){
                return AccountType::find($request->id);
            }else{
                return AccountType::all();
            }
        }
        if($request->method() == 'POST'){
            AccountType::validator($request->all())->validate();
            if($request->id){
                $AccountType = AccountType::find($request->id);
                return $AccountType->update($request->all());
            }else{
                $AccountType = new AccountType();
                return $AccountType->create($request->all());
            }
        }
    }


}
