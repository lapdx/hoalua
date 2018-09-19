<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Danh mục</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm" ng-click="openDialogCreateOrUpdate('create',null)" data-toggle="modal" data-target="#createManufacturer">
                        <i class="fa fa-plus"></i> Tạo mới
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('system.category.filter')
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover" ng-cloak>
                            <thead>
                                <tr role="row">
                                    <th class="col-md-2 text-center vertical-align">Ảnh</th>
                                    <th class="col-md-2 text-center vertical-align">Tên</th>
                                    <th class="col-md-2 text-center vertical-align">Trạng thái</th>
                                    <th class="col-md-2 text-center vertical-align">Vị trí</th>
                                    <th class="col-md-2 text-center vertical-align">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in categories track by $index">
                                    <td>
                                        <span ng-show="item.image != null"><img src="@{{uploadPath + item.image}}" style="max-width: 50px;max-height: 50px"/></span>
                                    </td>
                                    <td>
                                        <span>@{{item.title}}</span>
                                    </td>
                                    <td class="text-center vertical-align">
                                       <span class="label label-primary cursor">@{{getByField(statuses,'value',item.status).name}}</span>
                                    </td>
<!--                                    <td class="text-center vertical-align">
                                       <span class="label label-primary cursor">@{{getByField(types,'value',item.type).name}}</span>
                                    </td>-->
                                    <td class="text-center vertical-align">
                                        <span>@{{item.sorder}}</span>
                                    </td>
                                    <td class="text-center vertical-align">
                                        <button type="button" class="btn btn-sm btn-warning" title="Bộ lọc" data-toggle="modal" data-target="#filterForm" ng-click="openFilterFrom(item)"><i class="fa fa-filter"></i></button>
                                        <button type="button" class="btn btn-sm btn-info" title="Sửa" data-toggle="modal" data-target="#createManufacturer" ng-click="openDialogCreateOrUpdate('update',item)"><i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete(item)" title="Xóa"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr ng-show="categories.length == 0">
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
