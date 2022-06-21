@extends('adminlte::page')
@section('title', '相册所有人管理')

@section('content_header')
<h1>查看相册所有人</h1>
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
                            <th>序号</th>
                            <th>相册名称</th>
                            <th>相册所有人</th>
                            <th>访问权限</th>
                            <th>可用/隐藏/分享/下载</th>
                            <th>生日/年龄</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>序号</th>
                            <th>相册名称</th>
                            <th>相册所有人</th>
                            <th>访问权限</th>
                            <th>可用/隐藏/分享/下载</th>
                            <th>生日/年龄</th>
                            <th>操作</th>
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
                    "url": "/Admin/AlbumOwner/GetList",
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
                        "data": "album_name", "orderable": true, "visible": true
                    },
                    {
                        "data": "nick_name", "orderable": false, "visible": true
                    },
                    {
                        "data": "permisstion_text", "orderable": false, "visible": true
                    },
                    {
                        "data": null, "orderable": false, "visible": true,"render": function (data, type, row) {
                            var rowHtml;
                            var chkId="chkId"+data;
                            var isUsable=row.is_usable?'checked':'';
                            var isVisible=row.is_visible?'checked':'';
                            var downloadable=row.downloadable?'checked':'';
                            var shareable=row.shareable?'checked':'';
                            rowHtml = '<div class="icheck-primary d-inline">' +
                                '<input type="checkbox" '+isUsable+'>' +
                                '<label for="">' +'</label>' +'</div>' +
                                '<div class="icheck-primary d-inline">' +
                                '<input type="checkbox" '+isVisible+'>' +
                                '<label for="">' +'</label>' +'</div>' +
                                '<div class="icheck-primary d-inline">' +
                                '<input type="checkbox" '+shareable+'>' +
                                '<label for="">' +'</label>' +'</div>' +
                                '<div class="icheck-primary d-inline">' +
                                '<input type="checkbox" '+downloadable+'>' +
                                '<label for="">' +'</label>' +'</div>';

                            return rowHtml;
                        }
                    },
                    {
                        "data": null, "orderable": false, "visible": true,"render": function (data, type, row) {
                            var rowHtml;
                            var chkId="chkId"+data;
                            rowHtml = row.birthday+'/'+row.max_show_age

                            return rowHtml;
                        }
                    },
                    {
                        "data": "id", "orderable": false, "visible": true,"render": function (data, type, row) {
                            var rowHtml;
                            var chkId="chkId"+data;
                            rowHtml = '<a class="btn btn-primary btn-sm" href="/Admin/AlbumOwner/Edit/'+data+'">更新</a>'+
                            '<a class="btn btn-primary btn-sm" href="/Admin/Album/Index/'+data+'">管理</a>'
                            return rowHtml;
                        }
                    }
                ]

        });
    });
</script>
@stop
