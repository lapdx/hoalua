@extends('system.layouts.main', ['title' => 'Menu Management'])

@section('js')
    @parent
<!--<link href="/vendors/select2/select2.min.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/css/preview.css" rel="stylesheet" type="text/css" />-->
<!--<script type="text/javascript" src="/vendors/select2/select2.full.min.js"></script>-->
<script type="text/javascript" src="/js/controller/menu-controller.js?v={{ env('APP_VERSION') }}"></script>
<!--<script src="/js/frontend-controller/moment.js" charset="utf-8"></script>-->
<!--<link rel="stylesheet" href="/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">-->
<!--<script src="/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js" charset="utf-8"></script>-->
@endsection

@section('content-system')
    <div class="content-wrapper" ng-controller="MenuController" >
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Management</li>
                <li class="active">Menu</li>
            </ol>
            <br />
        </section>
        <section class="content">
            @include('system.setting.menu.list')
        </section>
    </div>
@stop
