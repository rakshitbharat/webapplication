<?php

namespace Modules\Country\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Yajra\Datatables\Datatables;
use Validator;

class Country extends Model {

    protected $table = 'country';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'status'];

    public static function dataOperation($request) {
        if ($request->method() == 'GET') {
            if ($request->datatable == 'yes') {
                return Datatables::of(self::select('*'))
                                ->addColumn('action', function ($data) {
                                    $tableName = with(new static)->getTable();
                                    $string = "<a href='javascript:;' onclick=edit('$data->id','$tableName') class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a>"
                                            . "<a href='javascript:;' onclick=destroyFinally('$data->id','$tableName') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
                                    return $string;
                                })
                                ->make(true);
            }if ($request->id) {
                return self::find($request->id);
            } else {
                return self::all();
            }
        }
        if ($request->method() == 'POST') {
            self::validator($request->all())->validate();
            if ($request->id) {
                self::find($request->id)->update($request->all());
                return 'done';
            } else {
                return self::create($request->all());
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
                    'title' => 'required|max:255|min:2',
        ]);
    }

}
