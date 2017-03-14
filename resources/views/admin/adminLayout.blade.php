<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name') }}| {{ $title or '' }}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin.cssLink')
        <script src="{{ asset('public/adminAsset/plugins/jQuery/jquery-2.2.3.min.js') }}" ></script>
        <script src="{{ asset('public/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    </head>
    <body class="skin-blue sidebar-mini" style="height: auto;">
        <div class="wrapper" style="height: auto;">
            @include('admin.header')        
            @include('admin.sidebar')       
            <div class="content-wrapper" style="min-height: 916px;">
                <section class="content-header">
                    @include('admin.flashMessage')       
                    @yield('contentHeader')
                </section>
                <section class="content">
                    @yield('content')
                </section>
            </div>
            @include('admin.footer')       
        </div>
        <div class="jvectormap-label"></div>
        @include('admin.jsLink')
        @yield('javascript')
        <script type = "text/javascript">
$(document).ready(function () {

    $(document).ajaxSend(function (event, request, settings) {
        Command: toastr["info"]("Working");
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": true,
            "preventOpenDuplicates": true,
            "onclick": null,
            "showDuration": "99999",
            "hideDuration": "99999",
            "timeOut": "99999",
            "extendedTimeOut": "99999",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });
    $(document).ajaxStart(function () {
        Command: toastr["info"]("Working");
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": true,
            "preventOpenDuplicates": true,
            "onclick": null,
            "showDuration": "99999",
            "hideDuration": "99999",
            "timeOut": "99999",
            "extendedTimeOut": "99999",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });
    $(document).ajaxComplete(function (event, request, settings) {
        toastr.clear();
    });
    $(document).ajaxError(function (event, request, settings) {
        toastr.clear();
    });
    $(document).ajaxStop(function () {
        toastr.clear();
    });
    setTimeout(function () {
        $('.msgBoxCont').hide();
    }, 9000);
    var currentLocation = '' + window.location + '';
    var pageFromURL = currentLocation.split("/");
    var pageFromClass = [];
    var pageSelector = null;
    $('.sidebar-menu').find('li').each(function ()
    {
        pageFromClass.push($(this).attr('class'));
        if ($.inArray($(this).attr('class'), pageFromURL) > 0) {
            pageSelector = $.inArray($(this).attr('class'), pageFromURL);
        }
    }
    );
    var finalPageSelect = pageFromURL[pageSelector];
    console.log(finalPageSelect);

    $('.sidebar-menu').find('li').each(function ()
    {
        $(this).removeClass('active');
        if ($(this).hasClass(finalPageSelect))
        {
            $(this).addClass('active');
            $(this).parent().parent().addClass('active');
        }
    }

    );
    $(window).scrollTop(0);
});
function destroyFinally(id, tableName) {
    var message = 'Record from table ' + tableName + ' has been deleted successfully.';
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
                        type: "GET",
                        url: '{!! route('admin_destroyFinally') !!}',
                        data: {id: id, tableName: tableName},
                        success: function (data) {
                            if (data == 0) {
                                swal({
                                    title: 'This record is associated with other records.',
                                    text: "Warning! it will destroy all associated records",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, Do it'
                                }, function (isConfirm) {
                                    if (isConfirm) {
                                        $.ajax({
                                            type: "GET",
                                            url: "{!! route('admin_destroyFinally') !!}",
                                            data: {id: id, tableName: tableName, force: 'yes'},
                                            success: function (data) {
                                                console.log(data);
                                                swal.close();
                                                flashMessage('success', message);
                                                var table = $('#dataTableBuilder').dataTable();
                                                table.fnDraw(false);
                                            },
                                            error: function () {
                                                swal(
                                                        'WhouuPs!',
                                                        'something went wrong',
                                                        'error'
                                                        );
                                            }
                                        });
                                    } else {
                                        swal.close();
                                        var table = $('#dataTableBuilder').dataTable();
                                        table.fnDraw(false);
                                    }
                                }
                                );
                            } else {
                                swal.close();
                                flashMessage('success', message);
                                var table = $('#dataTableBuilder').dataTable();
                                table.fnDraw(false);
                            }
                        }
                    }
                    );
                } else {
                    swal.close();
                }

            });
}

function flashMessage(type, message) {
    $(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        Command: toastr[type](message);
    });
}
$("select").select2({
    width: '100%',
});
        </script>
    </body>
</html>