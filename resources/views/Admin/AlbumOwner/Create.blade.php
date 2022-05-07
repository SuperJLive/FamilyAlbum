@extends('adminlte::page')
@section('title', '创建相册用户')

@section('content_header')
<h1>创建相册所有者</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">填写表单</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-right">相册名称</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="title" placeholder="请填写标题">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="owner" class="col-sm-2 col-form-label text-right">相册所有者</label>
                        <div class="col-sm-6">
                            <select id="AlbumOwner" class="form-control" style="width: 100%;"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="owner" class="col-sm-2 col-form-label text-right">相册权限</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="owner" placeholder="请填写标题">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label text-right">相册密码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" placeholder="访问密码">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Sign in</button>
                    <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    @stop

    @section('js')
    <script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script src="/plugins/select2/js/i18n/zh-CN.js"></script>
    <script type="text/javascript">
        $('#AlbumOwner').select2({
            theme: 'bootstrap4',
            language:'zh-CN',
            minimumInputLength :2,
            placeholder: '搜索用户',
        ajax: {
            method:'POST',
            headers:{'x-csrf-token' : $("meta[name='csrf-token']").attr('content')},
            delay: 500,
            url: '/Admin/User/GetUserSelect',
            dataType: 'json',
            data: function (params) {
                console.log(params);
            var query = {
                search: params.term
                
            };
            return query;
            },
            processResults: function (data,params) {
                params.page = params.page || 1;
                return {
                results: data
            };
        }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        }
        });

    </script>
    @stop