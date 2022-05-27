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
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" {{--
                                required data-msg-required="相册名称必须填写" --}} name="title" placeholder="请填写标题"
                                value="{{old('title')}}">
                            @error('title')
                            <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-right">相册归属人</label>
                        <div class="col-sm-6">
                            <select id="albumOwner" name="albumOwner" {{-- required data-msg-required="请选择相册所有人" --}}
                                class="form-control @error('albumOwner') is-invalid @enderror" style="width: 100%;">
                                <option></option>
                                @foreach ($albumOwners as $item)
                                <option value="{{$item['id']}}" {{old('albumOwner')==$item['id'] ? 'selected' : '' }}>
                                    {{$item['text']}}</option>
                                @endforeach
                            </select>
                            @error('albumOwner')
                            <span id="albumOwner-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="owner" class="col-sm-2 col-form-label text-right">相册权限</label>
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
                        <label for="password" class="col-sm-2 col-form-label text-right">相册密码</label>
                        <div class="col-sm-4">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="请填写密码">
                            @error('password')
                            <span id="password-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tags" class="col-sm-2 col-form-label text-right">标签</label>
                        <div class="col-sm-6">
                            <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror"
                                id=" tags" placeholder="选择标签">
                            @error('tags')
                            <span id="tags-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label text-right">拍摄区间</label>
                        <div class="col-sm-2">
                            <input type="text" name="minTakestamp"
                                class="form-control @error('minTakestamp') is-invalid @enderror" id="minTakestamp"
                                placeholder="最小拍摄时间">
                            @error('minTakestamp')
                            <span id="minTakestamp-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-2">
                            <input type="text" name="maxTakestamp"
                                class="form-control @error('maxTakestamp') is-invalid @enderror" id="maxTakestamp"
                                placeholder="最大拍摄时间">
                            @error('maxTakestamp')
                            <span id="maxTakestamp-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shareable" class="col-sm-2 col-form-label text-right">允许分享</label>
                        <div class="col-sm-2">
                            <select id="shareable" name="shareable" data-old="{{old('shareable')}}"
                                class="form-control @error('shareable') is-invalid @enderror" style="width: 100%;">
                                @foreach ($shares as $item)
                                <option value="{{$item['id']}}" {{old('permission')==$item['id'] ? 'selected' : '' }}>
                                    {{$item['text']}}</option>
                                @endforeach
                            </select>
                            @error('shareable')
                            <span id="shareable-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="downloadable" class="col-sm-1 col-form-label text-right">允许下载</label>
                        <div class="col-sm-2">
                            <select id="downloadable" name="downloadable" data-old="{{old('downloadable')}}"
                                class="form-control @error('downloadable') is-invalid @enderror" style="width: 100%;">
                                @foreach ($downloads as $item)
                                <option value="{{$item['id']}}" {{old('permission')==$item['id'] ? 'selected' : '' }}>
                                    {{$item['text']}}</option>
                                @endforeach
                            </select>
                            @error('downloadable')
                            <span id="downloadable-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label text-right">简述</label>
                        <div class="col-sm-6">
                            <textarea id="description" name="description"
                                class="form-control @error('description') is-invalid @enderror" rows="3"
                                placeholder="输入简述">{{old('description')}}</textarea>
                            @error('downloadable')
                            <span id="downloadable-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button id="btnOK" type="submit" class="btn btn-info">提交</button>
                    <button id="btnTest" type="button" class="btn btn-info">测试</button>
                    <button type="reset" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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
            $('#albumOwner').select2({
                theme: 'bootstrap4',
                language:'zh-CN',
                minimumResultsForSearch: -1,
                placeholder: "请选择一个相册集",
            });
            var shareableSelect2=function(){
                $('#shareable').select2({
                    theme: 'bootstrap4',
                    language:'zh-CN',
                    minimumResultsForSearch: -1,
                });
            }
            var downloadableSelect2=function(){
                $('#downloadable').select2({
                    theme: 'bootstrap4',
                    language:'zh-CN',
                    minimumResultsForSearch: -1,
                });
            }
            var permissionSelect2=function(){
                $('#permission').select2({
                    theme: 'bootstrap4',
                    language:'zh-CN',
                    minimumResultsForSearch: -1
                });
            }

            var showInheritInfo=function(id)
            {
                console.log(typeof(id));
                if(!id){
                    return;
                }
                $.ajax({url:"/Admin/Permission/getAlbumInheritText/"+ id,
                    type:'GET',
                    //dataType: "json",
                    headers:{'x-csrf-token' : $("meta[name='csrf-token']").attr('content')},
                    success:function (result) {
                        $('#shareable').find("option[value='0']").text(result.shareText);
                        $('#permission').find("option[value='0']").text(result.permissionText);
                        $('#downloadable').find("option[value='0']").text(result.downloadText);
                        permissionSelect2();
                        shareableSelect2();
                        downloadableSelect2();
                        // $('#shareable').empty();
                        // $('#downloadable').empty();
                        // var oldShareable=$('#shareable').data('old');
                        // var oldDownloadable=$('#downloadable').data('old');
                        // $('#shareable').select2({
                        //     theme: 'bootstrap4',
                        //     language:'zh-CN',
                        //     minimumResultsForSearch: -1,
                        //     data:result.shareable
                        // });
                        // $('#downloadable').select2({
                        //     theme: 'bootstrap4',
                        //     language:'zh-CN',
                        //     minimumResultsForSearch: -1,
                        //     data:result.downloadable
                        // });
                        // $('#permission').select2({
                        //     theme: 'bootstrap4',
                        //     language:'zh-CN',77777777777777
                        //     minimumResultsForSearch: -1,
                        //     data:result.permissions
                        // });
                        // if(oldShareable!==''){
                        //     $('#shareable').val(oldShareable).trigger('change');
                        // }
                        // if(oldDownloadable!==''){
                        //     $('#downloadable').val(oldDownloadable).trigger('change');
                        // }
                        // if(oldPermission!==''){
                        //     $('#permission').val(oldPermission).trigger('change');
                        // }
                    }
                });
            }
            permissionSelect2();
            shareableSelect2();
            downloadableSelect2();
            showInheritInfo($('#albumOwner').val())
            $('#albumOwner').on('select2:select', function (e) {
                var data = e.params.data;
                showInheritInfo(data.id);
            });
            $('#btnTest').on('click',function(){
                console.log($('#shareable').html());
                $('#shareable').html();
                $('#downloadable').html();
            });

        });

    </script>
    @stop
