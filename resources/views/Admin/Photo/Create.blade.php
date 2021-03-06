@extends('adminlte::page')
@section('title', '添加图片')

@section('content_header')
<h1>添加图片</h1>
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
            <form id="form-create" action="/Admin/Album/Store" class="form-horizontal dropzone" method="POST">
                {{-- enctype="multipart/form-data"> --}}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="owner" class="col-sm-2 col-form-label text-right">图片权限</label>
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
                        <label class="col-sm-2 col-form-label text-right">其它选项</label>
                        <div class="col-sm-6 icheck-center">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="shareable" name="shareable" value="1" id="order">
                                <label for="shareable">可分享
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="downloadable" name="downloadable" value="1" id="order">
                                <label for="downloadable">可下载
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label text-right">简介</label>
                        <div class="col-sm-6">
                            <textarea id="description" name="description" class="form-control" rows="3"
                                placeholder="输入简介"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button id="btnOK" type="submit" class="btn btn-info">提交</button>
                    <button type="reset" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>

    @stop

    @section('css')

    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/bootstrap-fileinput/css/fileinput.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{ asset('css/label.css') }}">
    @stop

    @section('js')
    <script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script src="/plugins/select2/js/i18n/zh-CN.js"></script>
    <script src="/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
    <script type="text/javascript">
        //Dropzone.autoDiscover = false;
        $(function(){
            $('#permission').select2({
                theme: 'bootstrap4',
                language:'zh-CN',
                minimumResultsForSearch: -1
            });
        });

    </script>
    @stop
