@extends('admin.adminLayout')
@section('content')
<div id="message-area">
</div>
<div class="portlet light portlet-fit portlet-datatable bordered">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
              <h2 class="box-title"><strong>{{ $title }}</strong></h2>
              <div class="box-tools pull-right">
                <div class="btn-group">
                    <a href="{{ Request::url() }}/create" class="btn btn-box-tool"><span class="glyphicon glyphicon-plus"></span>Add {{ $title }}</a>
                </div>
              </div>
            </div>
                <div class="box-body">
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover table-checkable" id="dataTableBuilder">
                                <thead>
                                    <tr>
                                        <th width="20px">No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Locked</th>
                                        <th  width="130px">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            The table contains {{ $title }}.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
    var table = $('#dataTableBuilder').DataTable({
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {

            var numStart = this.fnPagingInfo().iStart;

            var index = numStart + iDisplayIndexFull + 1;
            $("td:first", nRow).html(index);
            return nRow;
        },
        "oLanguage": {
            "sLengthMenu": "Display _MENU_ Records",
            "sZeroRecords": "<center>No Records Found!</center>",
            "sInfo": "Showing _START_ to _END_ of _TOTAL_ Records",
            "sInfoEmpty": "Showing 0 to 0 of 0 Records",
            "sInfoFiltered": "",
        },
        scrollX: true,
        bstateSave: true,
        responsive: true,
        bJQueryUI: false,
        bProcessing: true,
        bServerSide: true,
        bFilter: true,
        autoWidth: false,
        bLengthChange: true,
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        ajax: "{{ route('admin_normalusermanagementjson') }}",
        columns: [
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'locked'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
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
                                swal.close();
                                if (data == 1) {
                                    flashMessage('success', 'User has been locked successfully');
                                }
                                if (data == 0) {
                                    flashMessage('success', 'User has been unlocked successfully');
                                }

                                if (data == 2) {
                                    flashMessage('success', 'No Changes');
                                }
                                var dataTable = $('#dataTableBuilder').dataTable();
                                dataTable.fnFilter(this.value);
                            }
                        }
                        );
                    } else {
                        swal.close();
                    }
                });
    }
</script>
@endsection