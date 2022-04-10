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
                <form class="form-horizontal" method="POST" action="/Admin/Permission/Store">
                    <div class="row form-group">
                        <div class="col-2 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="title" placeholder="访问权限名称">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="title" placeholder="访问权限说明">
                        </div>
                        <div class="col-1">
                            <div class="form-group clearfix  icheck-center">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" checked>
                                    <label for="checkboxPrimary1">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-info">增加</button>
                        </div>

                    </div>
                </form>
                <div class="row form-group">

                    <div class="col-2 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">12</span>
                        </div>
                        <input type="text" class="form-control" id="title" placeholder="访问权限名称">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" id="title" placeholder="访问权限说明">
                    </div>
                    <div class="col-1">
                        <div class="form-group clearfix  icheck-center">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="checkboxPrimary1" checked>
                                <label for="checkboxPrimary1">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-info">编辑</button>
                        <button type="submit" class="btn btn-info">删除</button>
                    </div>

                </div>
                <div class="row form-group">

                    <div class="col-2 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">111111</span>
                        </div>
                        <input type="text" class="form-control" id="title" placeholder="访问权限名称">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" id="title" placeholder="访问权限说明">
                    </div>
                    <div class="col-1">
                        <div class="form-group clearfix  icheck-center">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="checkboxPrimary1" checked>
                                <label for="checkboxPrimary1">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-info">增加</button>
                    </div>

                </div>
                <div class="row form-group">

                    <div class="col-2 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">111111</span>
                        </div>
                        <input type="text" class="form-control" id="title" placeholder="访问权限名称">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" id="title" placeholder="访问权限说明">
                    </div>
                    <div class="col-1">
                        <div class="form-group clearfix  icheck-center">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="checkboxPrimary1" checked>
                                <label for="checkboxPrimary1">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-info">增加</button>
                    </div>

                </div>
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
    <script>
        console.log('Hi!');
    </script>

    @stop
