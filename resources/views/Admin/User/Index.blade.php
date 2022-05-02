@extends('adminlte::page')
@section('title', '用户列表')

@section('content_header')
<h1>编辑访问权限</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tblMain" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                <div class="icheck-primary d-inline"><input type="checkbox" id="chkAll"><label
                                        for="chkAll"></label></div>
                            </th>
                            <th>id</th>
                            <th>openid</th>
                            <th>nick_name</th>
                            <th>alow_login</th>
                            <th>first_login_time</th>
                            <th>last_login_time</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>openid</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@stop
@section('js')
<script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/plugins/datatables/jquery.datatables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(function () {
        var table = $("#tblMain").dataTable({
            "processing": true,
                "serverSide": true,
                "ajax": {
                    "type": "POST",  
                    "url": "/Admin/User/GetList",
                    headers:{'x-csrf-token' : $("meta[name='csrf-token']").attr('content')},
                    "data": function (data) {
                        var searchValue = $("#hidSearchValue").val();
                        var expireDays = $("#expireDays").val();
                        //data.AdditionalParameters[0].Key = "aaaa";//[{ Key: "AssetName", Value: assetName }];
                        //data.AdditionalParameters[0].Value = "bbb";
                        data.additionalParameters = { "SearchValue": searchValue, "ExpireDays": expireDays };
                        //AdditionalParameters[0].Key = "AssetName";
                        //AdditionalParameters[0].Value = assetName;
                        //val = { AdditionalParameters }
                        return data;
                    }
                },
                "order": [[1, "desc"]],
                //"order":true,
                "lengthMenu": [[50, 100, 256], [50, 100, 256]],
                // set the initial value
                "pageLength": 50,
                "pagingType": "full_numbers",
                "columns": [
                    {
                        "data": "id", "orderable": false, "visible": true,"render": function (data, type, row) {
                            var rowHtml;
                            var chkId="chkId"+data;
                            rowHtml = '<div class="icheck-primary d-inline">' +
                                '<input type="checkbox" id="'+chkId+'" value="'+data+'">' +
                                '<label for="'+chkId+'">' +
                                '</label>' +
                                '</div>';
                            return rowHtml;
                        }
                    },
                    {
                        "data": "id", "orderable": true, "visible": true
                    },
                    {
                        "data": "openid", "orderable": true, "visible": true
                    },
                    {
                        "data": "nick_name", "orderable": false, "visible": true
                    },
                    {
                        "data": "alow_login", "orderable": false, "visible": true
                    },
                    {
                        "data": "first_login_time", "orderable": false, "visible": true
                    },
                    {
                        "data": "last_login_time", "orderable": false, "visible": true
                    }
                ]

        });
    });
</script>
@stop