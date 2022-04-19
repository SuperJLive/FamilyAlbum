@extends('adminlte::page')
@section('title', '相册访问权限')

@section('content_header')
<h1>编辑访问权限</h1>
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

            <div class="card-body">
                <form id="form-permission-create" class="form-horizontal" method="POST"
                    action="/Admin/Permission/Store">
                    @csrf
                    <div class="row form-group">
                        <div class="col-2 input-group">
                            <div class="input-group-prepend input-group-prepend-validate">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control @error('permissionName') is-invalid @enderror"
                                id="permissionName" name="permissionName" placeholder="访问权限名称" value="{{old('
                                permissionName')}}">
                            @error('permissionName')
                            <span id="permissionName-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" placeholder="访问权限说明" value="{{old('description')}}">
                            @error('description')
                            <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control @error('order') is-invalid @enderror" id="order"
                                name="order" placeholder="排序" value="{{old('order')}}">
                            @error('order')
                            <span id="order-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-1">
                            <div class="form-group clearfix  icheck-center">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="isUsable" name="isUsable" value="1" id="order" checked>
                                    <label for="isUsable">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-info">增加</button>
                        </div>

                    </div>
                </form>
                @foreach ($permissions as $item)
                <div class="row form-group">
                    <input type="hidden" name="permissionId" value="{{$item->id}}">
                    <div class="col-2 input-group">

                        <div class="input-group-prepend input-group-prepend-validate">
                            <span class="input-group-text">{{$item->id}}</span>
                        </div>
                        <input type="text" class="form-control @error('permissionNameEdit') is-invalid @enderror"
                            id="permissionNameEdit" name="permissionNameEdit" placeholder="访问权限名称"
                            value={{$item->permission_name}}>
                        @error('permissionNameEdit')
                        <span id="permissionNameEdit-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control @error('descriptionEdit') is-invalid @enderror"
                            id="descriptionEdit" name="descriptionEdit" placeholder="访问权限说明"
                            value={{$item->description}}>
                        @error('descriptionEdit')
                        <span id="descriptionEdit-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-1">
                        <input type="text" class="form-control @error('orderEdit') is-invalid @enderror" id="orderEdit"
                            name="orderEdit" placeholder="排序" value={{$item->sorting_order}}>
                        @error('orderEdit')
                        <span id="orderEdit-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-1">
                        <div class="form-group clearfix  icheck-center">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="isUsableEdit" name="isUsableEdit" value="1" id="order"
                                    checked>
                                <label for="isUsableEdit">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-info btnUpdate">编辑</button>
                        <button type="submit" class="btn btn-info btnDelete">删除</button>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->

        </div>
    </div>
    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    @stop

    @section('js')
    <script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript">
        $("#form-permission-create1").validate({
            debug:false,
            rules:{
                    permissionName:{
                        required:true,
                        minlength:1,
                        maxlength:100
                    },
                    description:{
                        maxlength:500,
                    },
                    order : {
                        required: true,

                    }
                },
                messages:{
                    permissionName:{
                        required:'权限名称必须填写',
                        maxlength:'最大长度不能超过100'
                    },
                    description:{
                        maxlength:'最大长度不能超过500'
                    },
                    order : {
                        required: '排序必须填写'
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
        $(".btnUpdate").on("click", function () {
            var parentElement=$(this).parent().parent();
            var permissionId = parentElement.find("input[name='permissionId']").val();
            var permissionName = parentElement.find("input[name='permissionNameEdit']").val();
            var description = parentElement.find("input[name='descriptionEdit']").val();
            var order = parentElement.find("input[name='orderEdit']").val();
            var isUsable = parentElement.find("input[name='isUsableEdit']").prop("checked");
            console.log(permissionId+permissionName+description+order+isUsable);
            $.ajax({url: "/Admin/Permission/Update/" + permissionId,
                type:'POST',
                headers:{'x-csrf-token' : $("meta[name='csrf-token']").attr('content')},
                data:{ 'permissionName': permissionName,'description':description, 'order': order,'isUsable':isUsable },
                success:function (result) {
                    if (result.success) {
                        window.location.reload();
                    }
                }
            });
        });
        $(".btnDelete").on("click", function () {
            //console.log($("meta[name='csrf-token']").attr('content'));

            var parentElement=$(this).parent().parent();
            var permissionId = parentElement.find("input[name='permissionId']").val();
            console.log(permissionId);
            $.ajax({url:"/Admin/Permission/Destroy",
                data:{ 'id': permissionId },
                type:'POST',
                //dataType: "json",
                headers:{'x-csrf-token' : $("meta[name='csrf-token']").attr('content')},
                success:function (result) {
                    if (result.success) {
                        window.location.reload();
                    }
                }
            });
        });
    </script>

    @stop
