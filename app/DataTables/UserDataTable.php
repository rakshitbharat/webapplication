<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class UserDataTable extends DataTable {

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax() {
        $userManagement = User::where('id', '!=', Auth::id())
                ->select(['*']);

        return $this->datatables->of($userManagement)
                        ->editColumn('locked', function ($data) {

                            if ($data->locked == true) {
                                $string = "<a href='javascript:;' onclick=userLocking('$data->id','$data->locked') class='btn btn-xs btn-danger'><i class='fa fa-lock' aria-hidden='true'></i></a>";
                            }
                            if ($data->locked == false) {
                                $string = "<a href='javascript:;' onclick=userLocking('$data->id','$data->locked') class='btn btn-xs btn-success'><i class='fa fa-unlock' aria-hidden='true'></i></a>";
                            }

                            return $string;
                        })
                        ->addColumn('action', function ($data) {
                            $tableName = 'users';
                            $routeForEdit = route('admin_usermanagement.edit', array('id' => $data->id));
                            $string = "<a href='$routeForEdit' class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a>"
                                    . "<a href='javascript:;' onclick=destroyFinally('$data->id','$tableName') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
                            return $string;
                        })
                        ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query() {
        $query = User::query();

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html() {
        return $this->builder()
                        ->columns($this->getColumns())
                        ->ajax('')
                        ->addAction(['width' => '130px'])
                        ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns() {
        return ['id', 'name', 'email', 'role', 'locked'];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename() {
        return 'userdatatables_' . time();
    }

}
