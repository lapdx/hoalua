<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Đơn hàng</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm" ng-click="openDialogCreateOrUpdate('create', null)" data-toggle="modal" data-target="#createManufacturer">
                        <i class="fa fa-plus"></i> Tạo mới
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('system.inoutput.filter')
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover" ng-cloak>
                            <thead>
                                <tr role="row">
                                    <th class="col-md-1 text-center vertical-align">TG Tạo</th>
                                    <th class="col-md-1 text-center vertical-align">Mã</th>
                                    <th class="col-md-1 text-center vertical-align">Khách hàng</th>
                                    <th class="col-md-2 text-center vertical-align">ĐC.Giao hàng</th>
                                    <th class=" text-center vertical-align">Sản phẩm</th>
                                    <th class="col-md-2 text-center vertical-align">Ghi chú</th>
                                    <th class="col-md-2 text-center vertical-align">Tổng tiền</th>
                                    <th class="col-md-1 text-center vertical-align">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in inoutputs track by $index">
                                    <td>
                                        <span>@{{toVietnameseDate(item.created_at,true)}}</span>
                                    </td>
                                    <td>
                                        <span>@{{item.code}}</span>
                                    </td>
                                    <td>
                                        <p>@{{item.name}}</p>
                                        <p>@{{item.phone}}</p>
                                        <p>@{{item.email}}</p>
                                    </td>
                                    <td>
                                        <span>@{{item.delivery_address}}</span>
                                    </td>
                                    <td>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tên</th>
                                                    <th scope="col">Sl</th>
                                                    <th scope="col">Giá</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="p in item.inoutput_items track by p.id">
                                                    <td>@{{p.product_name}}</td>
                                                    <td>@{{p.quantity}}</td>
                                                    <td>@{{moneyToString(p.unit_price)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <span>@{{item.note}}</span>
                                    </td>
                                    </td>
                                    <td>
                                        <span>@{{moneyToString(item.amount)}}</span>
                                    </td>
                                    <td class="text-center vertical-align">
                                        <span ng-click="changeStatus(item)" class="label label-primary cursor">@{{getByField(statuses, 'value', item.status).name}}</span>
                                    </td>
                                </tr>
                                <tr ng-show="inoutputs.length == 0">
                                    <td colspan="4">No data...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @include('system.layouts.inc.paginator', ["accessPageId" => "pageId", "accessPagesCount" => "pagesCount", "accessFind" => "find(null)"])
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
