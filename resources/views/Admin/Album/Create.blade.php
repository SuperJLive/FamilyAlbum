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
            <form class="form-horizontal">

                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="/Admin/Album/Store"
                    id="form-create">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label text-right">相册标题</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="title" name="title" placeholder="请填写标题"
                                    required data-msg-required="相册名称必须填写">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="owner" class="col-sm-2 col-form-label text-right">上传图片</label>
                            <div class="col-sm-6">

                                <ul id="dropzoneUpload" class="dropzone dz-clickable dz-started thumbnails">
                                    <li id="dz-template" class="dz-preview1">
                                        <a class="dz-image" dz-image href="javascript:void(0);" title="photo">
                                            <img data-dz-thumbnail>
                                        </a>
                                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span>
                                        </div>
                                        <div class="dz-success-mark"><span>✔</span></div>
                                        <div class="dz-error-mark"><span>✘</span></div>
                                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                        <div class="tags">
                                            <span data-dz-name class="badge badge-primary"></span>
                                        </div>
                                        <div class="tools">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a data-dz-remove href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>

                                </ul>
                                </li>
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
<div class="dz-preview dz-file-preview">
    <div class="dz-details">
        <div class="dz-filename"><span data-dz-name></span></div>
        <div class="dz-size" data-dz-size></div>
        <img data-dz-thumbnail />
    </div>
    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
    <div class="dz-success-mark"><span>✔</span></div>
    <div class="dz-error-mark"><span>✘</span></div>
    <div class="dz-error-message"><span data-dz-errormessage></span></div>
</div>
<ul id="dropzoneUpload1" class="dropzone dz-clickable dz-started thumbnails">
    <li id="dz-template1">
        <a class="dz-image" dz-image href="javascript:void(0);" title="photo">
            <img data-dz-thumbnail src="/images/image-1.jpg" width="150" height="150">
        </a>
        <div class="tags">
            <span class="badge badge-primary">主要标签</span>
            <span class="badge badge-danger">主要标签</span>
        </div>
        <div class="tools">
            <a href="#">
                <i class="fa fa-link"></i>
            </a>
            <a href="#">
                <i class="fa fa-paperclip"></i>
            </a>
            <a href="#">
                <i class="fa fa-pencil"></i>
            </a>
            <a href="#">
                <i class="fa fa-times red"></i>
            </a>
        </div>
    </li>
</ul>
<div class="dz-preview dz-image-preview">
    <div class="dz-image"><img data-dz-thumbnail="" alt="Dz5fYyvUR2bHbyMSLUW4NR8kVD172gNb.jpg" src=""></div>
    <div class="dz-details">
        <div class="dz-size"><span data-dz-size=""><strong>61.9</strong> KB</span></div>
        <div class="dz-filename"><span data-dz-name="">Dz5fYyvUR2bHbyMSLUW4NR8kVD172gNb.jpg</span></div>
    </div>
    <div class="dz-progress"> <span class="dz-upload" data-dz-uploadprogress=""></span> </div>
    <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
    <div class="dz-success-mark"> <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1"
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <title>Check</title>
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <path
                    d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                    stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF"></path>
            </g>
        </svg> </div>
    <div class="dz-error-mark"> <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1"
            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <title>Error</title>
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                    <path
                        d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z">
                    </path>
                </g>
            </g>
        </svg> </div> <a class="dz-remove" href="javascript:undefined;" data-dz-remove="">Remove file</a>
</div>
@stop

@section('css')

<link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="/plugins/dropzone/dropzone.css">
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="{{ asset('css/dropzone_custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/label.css') }}">
@stop

@section('js')
<script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script src="/plugins/select2/js/i18n/zh-CN.js"></script>
<script src="/plugins/dropzone/min/dropzone.min.js"></script>
<script type="text/javascript">
    Dropzone.autoDiscover = false;
        Dropzone.options.dropzoneUpload = false
        $(function(){
            $('#permission').select2({
                theme: 'bootstrap4',
                language:'zh-CN',
                minimumResultsForSearch: -1
            });
            //dropzone temp
            var previewNode = document.querySelector("#dz-template");
                previewNode.id = "";
                var previewTemplate = previewNode.parentNode.innerHTML;
                previewNode.parentNode.removeChild(previewNode);
            var dropzoneUpload = new Dropzone("#dropzoneUpload", {
                url: "/Admin/Album/Store",
                thumbnailWidth: 150,
                thumbnailHeight: 150,
                dictDefaultMessage: '新建相册的同时可以上传最多8张图片，也可以只上传封面或先不上传！',
                paramName: "mediaFile",
                autoProcessQueue: true,
                //addRemoveLinks: true,
                previewTemplate: previewTemplate,
                //previewTemplate: '<div>1</div>'
            });
            dropzoneUpload.uploadFiles = function(files) {
			    var self = this;
                var maxSteps=500,
                 minSteps=1,
                timeBetweenSteps = 100,
			      bytesPerStep = 100000;
			    for (var i = 0; i < files.length; i++) {
			      var file = files[i];
			          totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

			      for (var step = 0; step < totalSteps; step++) {
			        var duration = timeBetweenSteps * (step + 1);
			        setTimeout(function(file, totalSteps, step) {
			          return function() {
			            file.upload = {
			              progress: 100 * (step + 1) / totalSteps,
			              total: file.size,
			              bytesSent: (step + 1) * file.size / totalSteps
			            };

			            self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
			            if (file.upload.progress == 100) {
			              file.status = Dropzone.SUCCESS;
			              self.emit("success", file, 'success', null);
			              self.emit("complete", file);
			              self.processQueue();
			            }
			          };
			        }(file, totalSteps, step), duration);
			      }
			    }
			   };

            // $('#dropzoneUpload').dropzone({
            //     url: "/Admin/Album/Create"
            // });
            // Dropzone.options.dropzoneUpload = {
            //     url: "/Admin/Album/Create",
            //     dictDefaultMessage: '拖动文件至此或者点击上传',
            //     paramName: "mediaFile",
            //     autoProcessQueue: false
            // };

        });

</script>
@stop
