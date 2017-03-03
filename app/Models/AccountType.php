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


}
