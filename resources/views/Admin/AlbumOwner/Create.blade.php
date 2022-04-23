@extends('adminlte::page')
@section('title', '创建相册用户')

@section('content_header')
<h1>创建相册所有者</h1>
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
      <form class="form-horizontal">
        <div class="card-body">
          <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label text-right">相册名称</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="title" placeholder="请填写标题">
            </div>
          </div>
          <div class="form-group row">
            <label for="owner" class="col-sm-2 col-form-label text-right">相册所有者</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="owner" placeholder="请填写标题">
            </div>
          </div>
          <div class="form-group row">
            <label for="owner" class="col-sm-2 col-form-label text-right">相册权限</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="owner" placeholder="请填写标题">
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label text-right">相册密码</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="password" placeholder="访问密码">
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
  @stop

  @section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  @stop

  @section('js')
  <script>
    console.log('Hi!'); 
  </script>
  @stop