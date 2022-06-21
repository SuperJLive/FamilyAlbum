@extends('adminlte::page')
@section('title', '创建相册用户')

@section('content_header')
<h1>修改相册集</h1>
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
            <form class="form-horizontal" id="form-create" method="post" action="/Admin/Albums/Update">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-right">相册集名称</label>
                        <div class="col-sm-6">
                            <input type="hidden" id="albumsId" name="id" value="{{$albums->id}}">
                            <input type="text" class="form-control @error('albumsName') is-invalid @enderror"
                                id="albumsName" name="albumsName" placeholder="请填写标题" required
                                data-msg-required="相册集名称必须填写"
                                value="{{old('albumsName')===null?$albums->album_name:old('albumsName')}}">
                            @error('albumsName')
                            <span id="albumsName-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="owner" class="col-sm-2 col-form-label text-right">关联用户</label>
                        <div class="col-sm-6">
                            <input type="hidden" id='ownerText' name='ownerText'
                                value="{{old('albumsText')==null?'无':old('albumsText')}}">
                            <select id="owner" name="owner" class="form-control @error('owner') is-invalid @enderror"
                                style="width: 100%;">
                                @if(old('owner')!==null)
                                <option value="{{old('owner')}}" selected>{{old('ownerText')}}</option>
                                @else
                                <option value="0" selected>无</option>
                                @endif
                            </select>
                            @error('owner')
                            <span id="owner-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="owner" class="col-sm-2 col-form-label text-right">相册权限</label>
                        <div class="col-sm-4">
                            <select id="permission" name="permission" class="form-control" style="width: 100%;">
                                @foreach ($permissions as $item)
                                <option value="{{$item['id']}}" {{(old('permission')===null?$albums->
                                    permission:old('permission'))==$item['id'] ? 'selected' : '' }}>
                                    {{$item['text']}}</option>
                                @endforeach
                            </select>
                            @error('permission')
                            <span id="permission-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <button id="permissionSetup" type="button" data-toggle="modal"
                                data-target="#modal-permission" class="btn btn-info">设置</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label text-right">相册密码</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="请填写密码"
                                value="{{old('password')===null?$albums->password:old('password')===null}}">
                            @error('password')
                            <span id="password-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">其它选项</label>
                        <div class="col-sm-6 icheck-center">
                            <input type="hidden" name="isUsable" value="0">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="isUsable" name="isUsable" value="1"
                                    {{old('isUsable')===null?($albums->is_usable?'checked':''):(old('isUsable')?'checked':'')}}>
                                <label for="isUsable" class="@error('isUsable') invalid-icheck @enderror">是否可用
                                </label>
                            </div>
                            <input type="hidden" name="isVisible" value="0">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="isVisible" name="isVisible" value="1"
                                    {{old('isVisible')===null?($albums->is_visible?'checked':''):(old('isVisible')?'checked':'')}}>
                                <label for="isVisible" class="@error('isVisible') invalid-icheck @enderror">是否可见
                                </label>
                            </div>
                            <input type="hidden" name="shareable" value="0">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="shareable" name="shareable" value="1"
                                    {{old('shareable')===null?($albums->shareable?'checked':''):(old('shareable')?'checked':'')}}>
                                <label for="shareable" class="@error('shareable') invalid-icheck @enderror">可分享
                                </label>
                            </div>
                            <input type="hidden" name="downloadable" value="0">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="downloadable" name="downloadable" value="1"
                                    {{old('downloadable')===null?($albums->downloadable?'checked':''):(old('downloadable')?'checked':'')}}>
                                <label for="downloadable" class="@error('downloadable') invalid-icheck @enderror">可下载
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maxShowAge" class="col-sm-2 col-form-label text-right">最大显示年龄</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('maxShowAge') is-invalid @enderror"
                                id="maxShowAge" name="maxShowAge" placeholder="请填写最大显示年龄"
                                value="{{old('maxShowAge')==null?$albums->max_show_age:old('maxShowAge')}}">
                            @error('maxShowAge')
                            <span id="maxShowAge-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <label for="birthday" class="col-sm-1 col-form-label text-right">生日</label>
                        <div class="col-sm-3">
                            <div class="input-group date" id="divBirthday" data-target-input="nearest">
                                <input type="text"
                                    class="form-control datetimepicker-input @error('birthday') is-invalid @enderror"
                                    id="birthday" name="birthday" placeholder="请填写生日"
                                    value="{{old('birthday')===null?$albums->birthday:old('birthday')}}"
                                    data-target="#divBirthday">
                                <div class="input-group-append" data-target="#divBirthday" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('birthday')
                                <span id="birthday-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-right">排序</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('order') is-invalid @enderror" id="order"
                                name="order" placeholder="请填写排序数字" required data-msg-required="排序必须填写"
                                value="{{old('order')==null?$albums->sorting_order:old('order')}}">
                            @error('order')
                            <span id="order-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="extension" class="col-sm-2 col-form-label text-right">扩展设置</label>
                        <div class="col-sm-6">
                            <textarea id="extension" name="extension"
                                class="form-control @error('extension') is-invalid @enderror" rows="3"
                                placeholder="扩展设置">{{old('extension')===null?$albums->extinesion:old('extension')}}</textarea>
                            @error('extension')
                            <span id="extension-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label text-right">简介</label>
                        <div class="col-sm-6">
                            <textarea id="description" name="description"
                                class="form-control @error('description') is-invalid @enderror" rows="3"
                                placeholder="输入简介">{{old('description')===null?$albums->description:old('description')}}</textarea>
                            @error('description')
                            <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">提交</button>
                    <button type="reset" class="btn btn-default float-right">取消</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
    <div class="modal fade" id="modal-permission">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">选择允许访问的用户组</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-content"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @stop

    @section('css')
    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script src="/plugins/select2/js/i18n/zh-CN.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#modal-permission').on('show.bs.modal', function () {
                $.get("/Admin/AlbumsPermission/ModalIndex/"+$('#albumsId').val(),
                function(data,status){
                    console.log(data);
                    $('#modal-content').html(data);
                });
            });
            $('#form-create').validate().resetForm();
            $('#form-create').removeData("validator");
            $('#form-create').validate({
                // rules:{
                //     // title:{
                //     //     required:true,
                //     //     minlength:2,
                //     //     maxlength:100
                //     // },
                //     // description:{
                //     //     maxlength:500,
                //     // }
                // },
                messages:{
                    title:{
                        required:'相册名称必须填写',
                        maxlength:'最大长度不能超过100'
                    },
                    description:{
                        maxlength:'最大长度不能超过500'
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('div[class^="col"]').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
        });
        $('#divBirthday').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#permission').select2({
            theme: 'bootstrap4',
            language:'zh-CN',
            minimumResultsForSearch: -1
        });

        $('#albums').on('select2:select', function (e) {
            var data = e.params.data;
            $('#albumsText').val(data.text);

        });
        $('#albums').select2({
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
