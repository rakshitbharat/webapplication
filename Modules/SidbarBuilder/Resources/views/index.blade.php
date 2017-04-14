@extends('admin.adminLayout')
@section('content')
<button type="button" id="add" onclick="$('#edit').modal('show');$('#addEdit')[0].reset();$('#id').val(null);" class="btn btn-box-tool"><i class="fa fa-plus"></i> Add {{ $title }}</button>
<table class="table table-striped table-bordered table-hover table-checkable" id="dataTableBuilder">
    <thead>
        <tr>
            <th width="20px">No</th>
            <th>Title</th>
            <th>status</th>
            <th  width="130px">Action</th>
        </tr>
    </thead>
</table>
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addEdit" class="form-group" method="POST">
                <div class="modal-body">
                    <div id="form-errors"></div>
                    <div class = "form-group">
                        <label for = "name">Title</label>
                        <input class = "form-control" rows = "3" id="title" name="title"></textarea>
                    </div>
                    <div class = "form-group">
                        <label for = "name">status</label>
                        <input class = "form-control" rows = "3" id="status" name="status"></textarea>
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
</div>
@stop
@section('javascript')
<script>
    var table = $('#dataTableBuilder').DataTable({
        bProcessing: true,
        bServerSide: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('sidbarBuilderListAddEditDelete') }}?datatable=yes",
        columns: [
            {data: 'id'},
            {data: 'title'},
            {data: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    function edit(id) {
        $('#edit').modal('show');
        $.getJSON("{{ route('sidbarBuilderListAddEditDelete') }}", {id: id}, function (json) {
            $.each(json, function (key, value) {
                $('input[name="' + key + '"]').val(value);
                $('textarea[name="' + key + '"]').val(value);
                $("select[name=" + key + "]").val(value).trigger("change");
                $("select[name=" + key + "]").val(value);
            });
        });
    }

    $('form#addEdit').submit(function (event) {
        $.ajax({
            type: "POST",
            url: "{{ route('sidbarBuilderListAddEditDelete') }}",
            data: $('form#addEdit').serialize(),
            success: function () {
                $('#dataTableBuilder').dataTable().fnDraw(false);
                $('#edit').modal('hide');
            },
            error: function (jqXhr) {
                if (jqXhr.status === 422) {
                    $.each(jqXhr.responseJSON, function (key, value) {
                        $('input[name="' + key + '"]').notify(
                                value,
                                {position: "top"}
                        );
                        $('textarea[name="' + key + '"]').notify(
                                value,
                                {position: "top"}
                        );
                        $("select[name=" + key + "]").notify(
                                value,
                                {position: "top"}
                        );
                        $("select[name=" + key + "]").notify(
                                value,
                                {position: "top"}
                        );
                    });
                } else {
                }
            }
        });
        event.preventDefault();
    });
</script>
@endsection


