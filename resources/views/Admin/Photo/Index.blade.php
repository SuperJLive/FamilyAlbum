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
                            <option value="{{$item['id']}}" {{$item['id']==0 ? 'selected' : '' }}>
                                {{$item['text']}}</option>
                            @endforeach
                        </select>
                        @error('permission')
                        <span id="permission-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-2">
                        <select id="shareable" name="shareable" required data-msg-required="必须选择"
                            class="form-control @error('shareable') is-invalid @enderror" style="width: 100%;">
                            @foreach ($permissions['shareable'] as $item)
                            <option value="{{$item['id']}}" {{$item['id']==0 ? 'selected' : '' }}>
                                {{$item['text']}}</option>
                            @endforeach
                        </select>
                        @error('shareable')
                        <span id="shareable-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-sm-2">
                        <select id="downloadable" name="downloadable" required data-msg-required="必须选择"
                            class="form-control @error('downloadable') is-invalid @enderror" style="width: 100%;">
                            @foreach ($permissions['downloadable'] as $item)
                            <option value="{{$item['id']}}" {{$item['id']==0 ? 'selected' : '' }}>
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
    <div id="zoomTemplate">
        <div class="form-group col-sm-12">
            <label for="title">标题</label>
            <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="相册标题">
            <label for="permissionPhoto">访问权限</label>
            <select id="permissionPhoto" name="permissionPhoto" required data-msg-required="权限必须选择"
                class="form-control form-control-sm @error('permission') is-invalid @enderror" style="width: 100%;">
                @foreach ($permissions['permission'] as $item)
                <option value="{{$item['id']}}" {{$item['id']==0 ? 'selected' : '' }}>
                    {{$item['text']}}</option>
                @endforeach
            </select>
            <label for="password">密码</label>
            <input type="password" class="form-control form-control-sm" id="password" name="password"
                placeholder="相册密码">
            <label for="title">拍摄地点</label>
            <input type="text" class="form-control form-control-sm" id="location" name="location" placeholder="拍摄地点">
            <div class="row">
                <div class="col-sm-6">
                    <label for="shareablePhoto">是否可分享</label>
                    <select id="shareablePhoto" name="shareablePhoto" required data-msg-required="权限必须选择"
                        class="form-control form-control-sm" style="width: 100%;">
                        @foreach ($permissions['shareable'] as $item)
                        <option value="{{$item['id']}}" {{$item['id']==0 ? 'selected' : '' }}>
                            {{$item['text']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="downloadablePhoto">是否可下载</label>
                    <select id="downloadablePhoto" name="downloadablePhoto" required data-msg-required="必须选择"
                        class="form-control form-control-sm" style="width: 100%;">
                        @foreach ($permissions['downloadable'] as $item)
                        <option value="{{$item['id']}}" {{$item['id']==0 ? 'selected' : '' }}>
                            {{$item['text']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group clearfix  icheck-center col-sm-6">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="isCover" name="isCover" value="1">
                        <label for="isCover">设置为封面
                        </label>
                    </div>
                </div>
                <div class="form-group clearfix  icheck-center col-sm-6">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="isShowPhoto" name="isShowPhoto" value="1" checked>
                        <label for="isShowPhoto">是否展示
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">简述</label>
                <textarea id="description" name="description"
                    class="form-control form-control-sm @error('description') is-invalid @enderror" rows="3"
                    placeholder="输入简述">{{old('description')}}</textarea>
            </div><input type="hidden" id="previewId">
            <button type="button" id="btnSavePhotoInfo" class="btn btn-primary">保存</button>

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
        var test=[{'id':1,'val':1},{'id':2,'val':2},{'id':3,'val':3}];
        test[1].val=999;
        console.log(test);
        var tModalLabel='kvFileinputModalLabel';
        var zoomTemplate=$('#zoomTemplate').html();
        $('#zoomTemplate').html('');
        var photos=new Array();
        $("#mediaFile").fileinput({'showUpload':false, 'previewFileType':'any',
        language: 'zh',
        uploadUrl: "/Admin/Photo/Store",
        ajaxSettings: { headers: {'x-csrf-token' : $("meta[name='csrf-token']").attr('content')} },
        maxFileSize:{{$uploadMaxFilesize}},
        //extra: {id: 100,},
        autoReplace:false,
        showUpload:true,//显示input里的上传，可以一次指上传
        showUploadedThumbs:true,//当input显示上传这条才有作用，上传完仍然显示缩略图。
        // enableResumableUpload: true,
        // resumableUploadOptions: {
        //     testUrl: "/Admin/ChunkUploadFile/Upload",
        //     chunkSize: 2048, // 2 MB chunk size
        // },
        uploadExtraData: function(previewId, index){
            if(previewId){
                if(photos.length>0)
                {
                    var photo=photos.find(x=>x.uploadFileId==previewId);
                    if(photo){
                        return photo;
                    }
                }
            }
            return null;
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
            '    <div class="row room-image">\n' +
            '    <div class="kv-zoom-body col-sm-6 file-zoom-content {zoomFrameClass}"></div>\n' +
            '     <div class="col-sm-6" id="photoInfo">'+
                zoomTemplate +
                '</div>\n' +
            '    {prev} {next}\n' +
            '    <div class="kv-zoom-description"></div>\n' +
            '    <div class="kv-zoom-photo-save-notice"></div>\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n'
        }
        });

        $('#mediaFile').on('fileloaded', function(event, file, previewId, fileId, index, reader) {
            var permission=$('#permission option:selected').val();
            var downloadable=$('#downloadable option:selected').val();
            var shareable=$('#shareable option:selected').val();
            var isShow=$('#isShow:checked').val()?1:0;
            var albumId=$('#albumId').val();
            var location=$('#location').val();
            var temp={'previewId':previewId,'uploadFileId':fileId,'title':'','permission':permission,
                    'downloadable':downloadable,'shareable':shareable,'isShow':isShow,
                    'description':'','albumId':albumId,'takeStamp':'','location':'',
                    'size':file.size,'isCover':0,'password':''
                };
            photos.push(temp);
            //console.log(photos);
            //console.log(file);
            //console.log('fileloaded_previewId:'+previewId+",index:"+index)
            // console.log(fileId);
            // console.log(index);
            // console.log(reader);
        });
        $('#mediaFile').on('filepreajax', function(event, previewId, index) {

        });
        $('#mediaFile').on('fileremoved', function(event, id, index) {
            var photoIndex=photos.findIndex(x=>x.previewId==id);
            photos.splice(photoIndex,1);
        });
        $('#mediaFile').on('fileclear', function(event) {
            photos=[];
        });
        $('#mediaFile').on('filezoomshow', function(event, params) {
            console.log('File zoom show ', params.sourceEvent, params.previewId, params.modal);
            loadPhotoInfo(params.previewId);
            $('#btnSavePhotoInfo').on('click',function(){
                var saveNotice=$('.kv-zoom-photo-save-notice');
                saveNotice.html('保存中...')
                saveNotice.show();
                savePhotoInfo();
                saveNotice.html('保存成功')
                saveNotice.fadeOut('normal');
            })
        });
        $('#mediaFile').on('filezoomshown', function(event, params) {
        console.log('File zoom shown ', params.sourceEvent, params.previewId, params.modal);
        });
        //get preview dom element id
        $('#mediaFile').on('filezoomprev', function(event, params) {
            console.log('File zoom previous ', params.previewId, params.modal);
            previewId=$('#'+params.previewId.replace('.','\\.')).prev().attr("id");
            loadPhotoInfo(previewId);
        });
        //get next dom element id
        $('#mediaFile').on('filezoomnext', function(event, params) {
            console.log('File zoom next ', params.previewId, params.modal);
            previewId=$('#'+params.previewId.replace('.','\\.')).next().attr("id");
            loadPhotoInfo(previewId);
        });

        var loadPhotoInfo=function(previewId){
            var photo=photos.find(x=>x.previewId==previewId);
            console.log(photo);
            $('#title').val(photo.title);
            $('#permissionPhoto').val(photo.permission);
            $('#password').val(photo.password);
            $('#location').val(photo.location);
            $('#shareablePhoto').val(photo.shareable);
            $('#downloadablePhoto').val(photo.downloadable);
            $('#isCover').prop("checked", photo.isCover);
            $('#isShowPhoto').prop("checked", photo.isShow);
            $('#description').val(photo.description);
            $('#previewId').val(photo.previewId);
        }
        var savePhotoInfo=function(){
            var previewId=$('#previewId').val();
            var i=photos.findIndex(x=>x.previewId==previewId);
            photos[i].title=$('#title').val();
            photos[i].permission=$('#permissionPhoto').val();
            photos[i].password=$('#password').val();
            photos[i].location=$('#location').val();
            photos[i].shareable=$('#shareablePhoto').val();
            photos[i].downloadable=$('#downloadablePhoto').val();
            photos[i].isCover=$('#isCover').prop("checked")?1:0;
            photos[i].isShow=$('#isShowPhoto').prop("checked")?1:0;
            photos[i].description=$('#description').val();
        }

    //});
</script>
@stop
