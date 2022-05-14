@extends('adminlte::page')
@section('title', '创建相册')

@section('content_header')
<h1>创建相册</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Horizontal Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal dropzone">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-right">相册标题</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="title" name="title" placeholder="请填写标题" required
                                data-msg-required="相册名称必须填写">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="owner" class="col-sm-2 col-form-label text-right">相册封面</label>
                        <div class="col-sm-6">
                            <div class="btn-group w-100">
                                <span class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </span>
                                <button type="submit" class="btn btn-primary col start">
                                    <i class="fas fa-upload"></i>
                                    <span>Start upload</span>
                                </button>
                                <button type="reset" class="btn btn-warning col cancel">
                                    <i class="fas fa-times-circle"></i>
                                    <span>Cancel upload</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="owner" class="col-sm-2 col-form-label text-right">相册权限</label>
                        <div class="col-sm-6">
                            <select id="permission" name="permission" class="form-control" style="width: 100%;">
                                @foreach ($permissions as $item)
                                <option value="{{$item['id']}}" {{old('permission')==$item['id'] ? 'selected' : '' }}>
                                    {{$item['text']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label text-right">相册密码</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="password" placeholder="请填写密码">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label text-right">简介</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="3" placeholder="输入简介"></textarea>
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
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/dropzone/min/dropzone.min.css">
    @stop

    @section('js')
    <script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script src="/plugins/select2/js/i18n/zh-CN.js"></script>
    <script src="/plugins/dropzone/min/dropzone.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#permission').select2({
                theme: 'bootstrap4',
                language:'zh-CN',
                minimumResultsForSearch: -1
            });

            $("div#myId").dropzone({ url: "/Admin/Album/UploadFile" });
        });
    </script>
    @stop