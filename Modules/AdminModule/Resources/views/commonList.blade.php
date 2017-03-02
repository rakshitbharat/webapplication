@extends('admin.adminLayout')
@section('content')
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{ $title }} Listing</span>
        </div>
        <div class="actions">
            <a href="{{ Request::url() }}/create" class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-plus"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        {!! $dataTable->table() !!}
    </div>
</div>
@endsection

@section('javascript')
{!! $dataTable->scripts() !!}
<script>
    function destroyFinally(id, tableName) {
    swal({
    title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel !",
            closeOnConfirm: false,
            closeOnCancel: false
    },
            function (isConfirm) {
            if (isConfirm) {
            $.ajax({
            type: "POST",
                    url: '{!! route('admin_destroyFinally') !!}',
                    data: {id: id, tableName: tableName},
                    success: function (data) {
                    if (data == 0) {

                    swal(
                            'Cancelled',
                            '' + tableName + ' Associated with Other ' + tableName + ' Table so it can not be Deleted.',
                            'error'
                            );
                    } else {
                    swal(
                            'Deleted!',
                            '' + tableName + ' has been Deleted.',
                            'success'
                            );
                    var dataTable = $('#dataTableBuilder').dataTable();
                    dataTable.fnFilter(this.value);
                    }
                    }
            }
            );
            } else {
            swal("Cancelled", "Your data is safe :)", "error");
            }

            });
    }
</script>

<script>
    function userLocking(id, locked) {
    swal({
    title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Do it!",
            cancelButtonText: "No, cancel !",
            closeOnConfirm: false,
            closeOnCancel: false
    },
            function (isConfirm) {
            if (isConfirm) {
            $.ajax({
            type: "POST",
                    url: '{!! route('admin_lockUser') !!}',
                    data: {id: id, locked: locked},
                    success: function (data) {
                    if (data == 1) {
                    swal(
                            'Locked',
                            'User is Locked',
                            'error'
                            );
                    }

                    if (data == 0) {
                    swal(
                            'Unlocked!',
                            'User is Unlocked',
                            'success'
                            );
                    }

                    if (data == 2) {
                    swal(
                            'No Changes!',
                            '',
                            'success'
                            );
                    }


                    var dataTable = $('#dataTableBuilder').dataTable();
                    dataTable.fnFilter(this.value);
                    }
            }
            );
            } else {
            swal("Cancelled", "Your data is safe :)", "error");
            }

            });
    }
</script>
@endsection