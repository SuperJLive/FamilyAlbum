@extends('adminlte::page')
@section('title', '相册浏览')

@section('content_header')
<h1>相册浏览</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">相册</h3>
            </div>
            <div class="card-body row">
                <div class="col-sm-2">
                    <div class="card">
                        <img class="card-img-top" src="/images/image-1.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's
                                content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card">
                        <img class="card-img-top" src="/images/image-2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's
                                content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card">
                        <img class="card-img-top" src="/images/image-3.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's
                                content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card">
                        <img class="card-img-top" src="/images/image-4.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's
                                content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card">
                        <img class="card-img-top" src="/images/image-5.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's
                                content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card">
                        <img class="card-img-top" src="/images/image-6.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's
                                content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card">
                        <img class="card-img-top" src="/images/image-1.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's
                                content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card">
                        <img class="card-img-top" src="/images/image-1.jpg" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's
                                content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<style type="text/css">
    .card {
        margin-left: 4px;
        margin-right: 4px;
    }
</style>
@stop

@section('js')
<script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/plugins/jquery-validation/additional-methods.min.js"></script>
@stop