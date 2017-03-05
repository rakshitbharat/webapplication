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
                  <button type="button" id="add" class="btn btn-box-tool">
                    <i class="fa fa-plus"></i> Add {{ $title }}</button>
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
                                        <th>Contact Name</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
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
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $title }}</h4>
            </div>
            <form id="addEdit" class="form-group" method="POST">
                <div class="modal-body">
                    <div id="form-errors"></div>
                    <div class = "form-group">
                        <label for = "name">firstName</label>
                        <input class = "form-control" rows = "3" id="name" name="name"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id" name="id">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
    @section('javascript')
    <script>
        $("select").select2({
            width: '100%',
        });
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
            ajax: "{{ route('admin_contactJson') }}",
            columns: [
                {data: 'firstName'},
                {data: 'lastName'},
                {data: 'phone1'},
                {data: 'userId'},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        function edit(id) {
            $('#edit').modal('show');
            $.getJSON("{{ route('admin_contactAddEdit') }}", {id: id}, function (json) {
                $.each(json.data, function (key, value) {
                    if (!value) {
                        $('input[name="' + key + '"]').val(value).prop('readonly', true);
                        ;
                        $('textarea[name="' + key + '"]').val(value).prop('readonly', true);
                        ;
                        $("select[name=" + key + "]").val(value).trigger("change").prop('readonly', true);
                        ;
                    } else {
                        $('input[name="' + key + '"]').val(value);
                        $('textarea[name="' + key + '"]').val(value);
                        $("select[name=" + key + "]").val(value).trigger("change");
                    }

                });
            });
        }
         $("#add").click(function(){
                                         $('#edit').modal('show');
                                        $('#form-errors').html('');
                                        $('#addEdit')[0].reset();
                                        $('#id').val();
                                    });
        $('form#addEdit').validate({
            rules: {},
            messages: {},
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin_contactAddEdit') }}",
                    data: $(form).serialize(),
                    success: function (data) {
                                                        var table = $('#dataTableBuilder').dataTable();
                                                        table.fnDraw(false);
                                                        $('#edit').modal('hide');
                                                },
                                                error: function (jqXhr) {
                                                    if (jqXhr.status === 401)
                                                        $(location).prop('pathname', 'auth/login');
                                                    if (jqXhr.status === 422) {
                                                        var errors = jqXhr.responseJSON;
                                                        errorsHtml = '<div class="alert alert-danger"><ul>';
                                                        $.each(errors, function (key, value) {
                                                            errorsHtml += '<li>' + value[0] + '</li>';
                                                        });
                                                        errorsHtml += '</ul></di>';
                                                        $('#form-errors').html(errorsHtml);
                                                    } else {
                                                        $('#form-errors').html('');
                                                    }
                                                }
                });
                return false;
            }
        });
    </script>
    @endsection