@extends('system.layouts.main', ['title' => 'Order Management'])

@section('js')
@parent
<!--<link href="/vendors/select2/select2.min.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/css/preview.css" rel="stylesheet" type="text/css" />-->
<!--<script type="text/javascript" src="/vendors/select2/select2.full.min.js"></script>-->
<script type="text/javascript" src="/js/controller/out-controller.js?v={{ env('APP_VERSION')}}"></script>
<!--<script src="/js/frontend-controller/moment.js" charset="utf-8"></script>-->
<!--<link rel="stylesheet" href="/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">-->
<!--<script src="/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js" charset="utf-8"></script>-->
@endsection

@section('content-system')
<div class="content-wrapper" ng-controller="OutController" >
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Management</li>
            <li class="active">Order</li>
        </ol>
        <br />
    </section>
    <section class="content">
        @include('system.inoutput.list')
    </section>
    <div class="modal fade" id="changeStatus" role="dialog" data-keyboard="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thay đổi trạng thái</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Mã đơn hàng: @{{inoutput.code}}</p>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" ng-model="inoutput.status" ng-options="status as status.name for status in statuses track by status.value">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary save-status" ng-click="saveStatus()" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
