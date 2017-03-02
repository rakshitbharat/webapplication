<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    /**
     * Generated
     */

    protected $table = 'users';
    protected $fillable = ['id', 'name', 'email', 'role', 'confirmation_code', 'confirmed', 'locked', 'password', 'remember_token'];


    public function articleCategories() {
        return $this->belongsToMany(\App\Models\ArticleCategory::class, 'article', 'userId', 'categoryId');
    }

    public function articles() {
        return $this->hasMany(\App\Models\Article::class, 'userId', 'id');
    }


}
