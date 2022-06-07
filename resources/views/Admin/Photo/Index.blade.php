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
                        <input id="albumId" type="hidden" value="{{$albumId}}">
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
                        <input id="mediaFile" name="mediaFile" type="file" class="file" data-browse-on-zone-click="true"
                            multiple>
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
    //$(function(){
        var tModalLabel='kvFileinputModalLabel';
        $("#mediaFile").fileinput({'showUpload':false, 'previewFileType':'any',
        language: 'zh',
        uploadUrl: "/Admin/Photo/Store",
        ajaxSettings: { headers: {'x-csrf-token' : $("meta[name='csrf-token']").attr('content')} },
        //extra: {id: 100,},
        autoReplace:false,
        showUpload:true,//显示input里的上传，可以一次指上传
        showUploadedThumbs:true,//当input显示上传这条才有作用，上传完仍然显示缩略图。
        uploadExtraData: function(previewId, index){
            var title="";
            var albumId=$('#albumId').val();
            console.log(previewId+'previewId');
            console.log(index+'index');
            return {'albumId':albumId,'previewId':previewId,'index':index};
            },
        layoutTemplates:{
            modalMain: '<div id="kvFileinputModal" class="file-zoom-dialog modal fade" aria-labelledby="kvFileinputModalLabel" {tabIndexConfig}></div>',
            modal: '<div class="modal-dialog modal-lg{rtl}" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header kv-zoom-header">\n' +
            '      <h6 class="modal-title kv-zoom-title" id="' + tModalLabel + '"><span class="kv-zoom-caption"></span> <span class="kv-zoom-size"></span></h6>\n' +
            '      <div class="kv-zoom-actions">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '    </div>\n' +
            '    <div class="floating-buttons"></div>\n' +
            '    <div class="row">\n' +
            '    <div class="kv-zoom-body col-sm-5 file-zoom-content {zoomFrameClass}"></div>\n' +
            '     <div class="col-sm-5">aaa</div>\n' +
            '{prev} {next}\n' +
            '    <div class="kv-zoom-description"></div>\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n'
        }
        });
        $('#mediaFile').on('fileselect', function(event, numFiles, label) {
                        console.log(numFiles);
            console.log(label);
        });
        $('#mediaFile').on('fileloaded', function(event, file, previewId, fileId, index, reader) {
            // console.log(file);
            // console.log(previewId);
            // console.log(fileId);
            // console.log(index);
            // console.log(reader);
        });
        $('#mediaFile').on('filepreajax', function(event, previewId, index) {
            console.log('File pre ajax triggered');
        });
    //});
</script>
@stop
