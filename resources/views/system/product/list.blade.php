<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sản Phẩm</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm" ng-click="openDialogCreateOrUpdate('create',null)" data-toggle="modal" data-target="#createManufacturer">
                        <i class="fa fa-plus"></i> Tạo mới
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('system.product.filter')
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover" ng-cloak>
                            <thead>
                                <tr role="row">
                                    <th class=" text-center vertical-align">ID</th>
                                    <th class="col-md-1 text-center vertical-align">Ảnh</th>
                                    <th class="col-md-2 text-center vertical-align">Tên</th>
                                    <th class="col-md-2 text-center vertical-align">Giá hãng</th>
                                    <th class="col-md-2 text-center vertical-align">Giá bán</th>
                                    <th class="col-md-2 text-center vertical-align">Trạng thái</th>
                                    <th class="col-md-1 text-center vertical-align">Vị trí</th>
                                    <th class="col-md-2 text-center vertical-align">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in products track by $index">
                                    <td>
                                        <span>@{{item.id}}</span>
                                    </td>
                                    <td>
                                        <span ng-show="item.image_url != null"><img src="@{{uploadPath + item.image_url}}" style="max-width: 50px;max-height: 50px"/></span>
                                    </td>
                                    <td>
                                        <span>@{{item.title}}</span>
                                    </td>
                                    <td>
                                        <span>@{{moneyToString(item.price)}}</span>
                                    </td>
                                    <td>
                                        <span>@{{moneyToString(item.sale_price)}}</span>
                                    </td>
                                    <td class="text-center vertical-align">
                                       <span class="label label-primary cursor">@{{getByField(statuses,'value',item.status).name}}</span>
                                    </td>
                                    <td class="text-center vertical-align">
                                        <span>@{{item.sorder}}</span>
                                    </td>
                                    <td class="text-center vertical-align">
                                        <button type="button" class="btn btn-sm btn-primary" title="Ảnh" data-toggle="modal" data-target="#galleryForm" ng-click="openGallery(item)"><i class="fa fa-image"></i></button>
                                        <button type="button" class="btn btn-sm btn-warning" title="Cấu hình lọc" data-toggle="modal" data-target="#filterForm" ng-click="openFilterFrom(item)"><i class="fa fa-filter"></i></button>
                                        <button type="button" class="btn btn-sm btn-info" title="Sửa" data-toggle="modal" data-target="#createManufacturer" ng-click="openDialogCreateOrUpdate('update',item)"><i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete(item)" title="Xóa"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr ng-show="products.length == 0">
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
