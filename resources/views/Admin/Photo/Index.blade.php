{{-- @foreach ($permissions['permission'] as $item)
@dump($item)
@endforeach
@dd($permissions['permission']) --}}
@extends('adminlte::page')
@section('title', '浏览图片')

@section('content_header')
<h1>浏览图片</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">相册</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="owner" class="col-sm-1 col-form-label text-right">图片权限</label>
                    <div class="col-sm-3">
                        <select id="permission" name="permission" required data-msg-required="权限必须选择"
                            class="form-control @error('permission') is-invalid @enderror" style="width: 100%;">
                            @foreach ($permissions['permission'] as $item)
                            <option value="{{$item['id']}}" {{old('permission')==$item['id'] ? 'selected' : '' }}>
                                {{$item['text']}}</option>
                            @endforeach
                        </select>
                        @error('permission')
                        <span id="permission-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-2">
                        <select id="shareable" name="shareable" required data-msg-required="权限必须选择"
                            class="form-control @error('shareable') is-invalid @enderror" style="width: 100%;">
                            @foreach ($permissions['shareable'] as $item)
                            <option value="{{$item['id']}}" {{old('shareable')==$item['id'] ? 'selected' : '' }}>
                                {{$item['text']}}</option>
                            @endforeach
                        </select>
                        @error('shareable')
                        <span id="shareable-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2">
                        <select id="downloadable" name="downloadable" required data-msg-required="权限必须选择"
                            class="form-control @error('downloadable') is-invalid @enderror" style="width: 100%;">
                            @foreach ($permissions['downloadable'] as $item)
                            <option value="{{$item['id']}}" {{old('downloadable')==$item['id'] ? 'selected' : '' }}>
                                {{$item['text']}}</option>
                            @endforeach
                        </select>
                        @error('downloadable')
                        <span id="downloadable-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group clearfix  icheck-center">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="isShow" name="isShow" value="1" checked>
                                <label for="isShow">是否展示
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input id="uploadMedia" name="uploadMedia[]" type="file" class="file"
                            data-browse-on-zone-click="true" multiple>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <div class="card">
                            <img class="card-img-top" src="/images/image-1.jpg" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="/plugins/bootstrap-fileinput/css/fileinput.min.css">
<link rel="stylesheet" href="/plugins/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
<script src="/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
{{-- <script src="/plugins/bootstrap-fileinput/themes/bs5/theme.min.js"></script> --}}
<script src="/plugins/bootstrap-fileinput/js/locales/zh.js"></script>
<script>
    $("#uploadMedia").fileinput({'showUpload':false, 'previewFileType':'any',
    language: 'zh',
    uploadUrl: "/Admin/Photo/UploadMedia",
    autoReplace:false,
    showDescriptionClose:true,
    caption:'哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈',
    zoomIcon: '<i class="bi-arrows-move"></i>',
    actions: '<div class="file-actions">\n' +
        '    <div class="file-footer-buttons">\n' +
        '        {upload} {download} {delete} {zoom} {other}' +
        '    </div>\n' +
        '    {drag}\n' +
        '    <div class="file-upload-indicator" title="{indicatorTitle}">{indicator}</div>\n' +
        '    <div class="clearfix"></div>\n' +
        '</div>',
        actionOther: '<button type="button" class="kv-file-zoom {zoomClass}" title="{zoomTitle}">{zoomIcon}</button>',
    uploadExtraData: {
            'uploadToken': 'SOME-TOKEN', // for access control / security
        },
    });
</script>
@stop