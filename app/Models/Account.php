<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    /**
     * Generated
     */

    protected $table = 'account';
    protected $fillable = ['name', 'accountTypeId', 'userId'];


    public function accountType() {
        return $this->belongsTo(\App\Models\AccountType::class, 'accountTypeId', 'id');
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


}
