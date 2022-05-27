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
                    <label for="owner" class="col-sm-2 col-form-label text-right">图片权限</label>
                    <div class="col-sm-6">
                        <select id="permission" name="permission" required data-msg-required="权限必须选择"
                            class="form-control @error('permission') is-invalid @enderror" style="width: 100%;">
                            @foreach ($permissions as $item)
                            <option value="{{$item['id']}}" {{old('permission')==$item['id'] ? 'selected' : '' }}>
                                {{$item['text']}}</option>
                            @endforeach
                        </select>
                        @error('permission')
                        <span id="permission-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
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
    showDescriptionClose:false,
    uploadExtraData: {
            'uploadToken': 'SOME-TOKEN', // for access control / security
        },
    });
</script>
@stop