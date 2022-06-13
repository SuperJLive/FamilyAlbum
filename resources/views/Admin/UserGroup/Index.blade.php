@extends('adminlte::page')
@section('title', '用户组管理')

@section('content_header')
<h1>用户组管理</h1>
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
                <form id="form-group-create" class="form-horizontal" method="POST" action="/Admin/UserGroup/Store">
                    @csrf
                    <div class="row form-group">
                        <div class="col-2 input-group">
                            <div class="input-group-prepend input-group-prepend-validate">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control @error('groupName') is-invalid @enderror"
                                id="groupName" name="groupName" placeholder="用户组名称" value="{{old('groupName')}}">
                            @error('groupName')
                            <span id="groupName-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" placeholder="用户组说明" value="{{old('description')}}">
                            @error('description')
                            <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control @error('order') is-invalid @enderror" id="order"
                                name="order" placeholder="排序" value="{{old('order')==null?$maxOrder:old('order')}}">
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
                <div id="edit">
                    @foreach ($groups as $item)
                    <div class="row form-group">
                        <input type="hidden" name="groupId" value="{{$item->id}}">
                        <div class="col-2 input-group">

                            <div class="input-group-prepend input-group-prepend-validate">
                                <span class="input-group-text">{{$item->id}}</span>
                            </div>
                            <input type="text" class="form-control @error('groupNameEdit') is-invalid @enderror"
                                id="groupNameEdit" name="groupNameEdit" placeholder="用户组名称" value={{$item->group_name}}>
                            @error('groupNameEdit')
                            <span id="groupNameEdit-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control @error('descriptionEdit') is-invalid @enderror"
                                id="descriptionEdit" name="descriptionEdit" placeholder="用户组说明"
                                value={{$item->description}}>
                            @error('descriptionEdit')
                            <span id="descriptionEdit-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-1">
                            <input type="text" class="form-control @error('orderEdit') is-invalid @enderror"
                                id="orderEdit" name="orderEdit" placeholder="排序" value={{$item->sorting_order}}>
                            @error('orderEdit')
                            <span id="orderEdit-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-1">
                            <div class="form-group clearfix  icheck-center">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="isUsableEdit{{$item->id}}" name="isUsableEdit" value="1"
                                        {{$item->is_usable_checked}}>
                                    <label for="isUsableEdit{{$item->id}}">
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
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->

        </div>
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
    $("#form-group-create").validate({
            debug:false,
            rules:{
                    groupName:{
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
                    groupName:{
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
    //  $("input[name='groupNameEdit']").each(function(){
    //         $(this).rules("add",{required:true,minlength:1,maxlength:100,messages:{required:"权限名称必须填写"}});
    //      });
     //$("input[name='groupNameEdit']").rules("add",{required:true,minlength:1,maxlength:100,messages:{required:"权限名称必须填写"}});
        $(".btnUpdate").on("click", function () {

            // var validator =$("#edit").validate();
            // console.log(validator);
            // validator.element($("#groupNameEdit1"));
            var parentElement=$(this).parent().parent();
            var eUserGroupId = parentElement.find("input[name='groupId']");
            var eUserGroupName = parentElement.find("input[name='groupNameEdit']");
            var eDescription = parentElement.find("input[name='descriptionEdit']");
            var eOrder = parentElement.find("input[name='orderEdit']");
            var eIsUsable = parentElement.find("input[name^='isUsableEdit']");

            var groupId = eUserGroupId.val();
            var groupName = eUserGroupName.val();
            var description = eDescription.val();
            var order = eOrder.val();
            var isUsable = (eIsUsable.prop("checked"))?1:0;
            $.ajax({url: "/Admin/UserGroup/Update/" + groupId,
                type:'POST',
                headers:{'x-csrf-token' : $("meta[name='csrf-token']").attr('content')},
                data:{ 'groupName': groupName,'description':description, 'order': order,'isUsable':isUsable },
                error:function(jqXHR,textStatus,errorThrown )
                {
                    $.each(jqXHR.responseJSON.errors,function(name,value) {
                        switch(name){
                            case "groupName":
                                eUserGroupName.addClass("is-invalid");
                                break;
                            case "order":
                                eOrder.addClass("is-invalid");
                                break;
                            case "description":
                                eDescription.addClass("is-invalid");
                                break;
                        }
                    });

                },
                // statusCode:{
                //     422:function(result){
                //         console.log(result.responseJSON.errors);
                //     }
                // },
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
            var groupId = parentElement.find("input[name='groupId']").val();
            console.log(groupId);
            $.ajax({url:"/Admin/UserGroup/Destroy",
                data:{ 'id': groupId },
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