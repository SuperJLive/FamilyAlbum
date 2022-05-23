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
            <form id="form-create" action="/Admin/Album/Store" class="form-horizontal dropzone" method="POST">
                @csrf
                {{-- enctype="multipart/form-data"> --}}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-right">相册标题</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="title" name="title" placeholder="请填写标题" required
                                data-msg-required="相册名称必须填写">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-right">相册归属人</label>
                        <div class="col-sm-6">
                            <select id="albumOwner" name="albumOwner" required data-msg-required="请选择相册所有人"
                                class="form-control @error('albumOwner') is-invalid @enderror" style="width: 100%;">
                                <option></option>
                                @foreach ($albumOwners as $item)
                                <option value="{{$item['id']}}" {{old('albumOwner')==$item['id'] ? 'selected' : '' }}>
                                    {{$item['text']}}</option>
                                @endforeach
                            </select>
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
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="请填写密码">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tags" class="col-sm-2 col-form-label text-right">标签</label>
                        <div class="col-sm-6">
                            <input type="text" name="tags" class="form-control" id="tags" placeholder="选择标签">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label text-right">拍摄区间</label>
                        <div class="col-sm-2">
                            <input type="text" name="min_takestamp" class="form-control" id="min_takestamp"
                                placeholder="最小拍摄时间">
                        </div>

                        <div class="col-sm-2">
                            <input type="text" name="max_takestamp" class="form-control" id="max_takestamp"
                                placeholder="最大拍摄时间">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shareable" class="col-sm-2 col-form-label text-right">允许分享</label>
                        <div class="col-sm-2">
                            <select id="shareable" name="shareable"
                                class="form-control @error('shareable') is-invalid @enderror" style="width: 100%;">
                            </select>
                            @error('shareable')
                            <span id="shareable-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="downloadable" class="col-sm-1 col-form-label text-right">允许下载</label>
                        <div class="col-sm-2">
                            <select id="downloadable" name="downloadable"
                                class="form-control @error('downloadable') is-invalid @enderror" style="width: 100%;">
                            </select>
                            @error('downloadable')
                            <span id="downloadable-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
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
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{ asset('css/label.css') }}">
    @stop

    @section('js')
    <script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script src="/plugins/select2/js/i18n/zh-CN.js"></script>
    <script type="text/javascript">
        //Dropzone.autoDiscover = false;
        $(function(){
            $('#permission').select2({
                theme: 'bootstrap4',
                language:'zh-CN',
                minimumResultsForSearch: -1
            });
            $('#albumOwner').select2({
                theme: 'bootstrap4',
                language:'zh-CN',
                minimumResultsForSearch: -1,
                placeholder: "Select a state",
            });

            $('#albumOwner').on('select2:select', function (e) {
                var data = e.params.data;
                console.log(data.id);
                $.ajax({url:"/Admin/Album/getSDSelectItem/"+ data.id,
                type:'GET',
                //dataType: "json",
                headers:{'x-csrf-token' : $("meta[name='csrf-token']").attr('content')},
                success:function (result) {
                    $('#shareable').select2({
                        theme: 'bootstrap4',
                        language:'zh-CN',
                        minimumResultsForSearch: -1,
                        data:result.shareable
                    });
                    $('#downloadable').select2({
                        theme: 'bootstrap4',
                        language:'zh-CN',
                        minimumResultsForSearch: -1,
                        data:result.downloadable
                    });
                }
            });
            });
        });

    </script>
    @stop
