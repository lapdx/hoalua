<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thuộc tính bộ lọc</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm" ng-click="openDialogCreateOrUpdate('create',null)" data-toggle="modal" data-target="#createManufacturer">
                        <i class="fa fa-plus"></i> Tạo mới
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('system.attribute-value.filter')
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover" ng-cloak>
                            <thead>
                                <tr role="row">
                                    <th class="col-md-2 text-center vertical-align">Tên</th>
                                    <th class="col-md-2 text-center vertical-align">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in attributeValues track by $index">
                                    <td>
                                        <span>@{{item.content_value}}</span>
                                    </td>
                                    <td class="text-center vertical-align">
                                        <button type="button" class="btn btn-sm btn-info" title="Sửa" data-toggle="modal" data-target="#createManufacturer" ng-click="openDialogCreateOrUpdate('update',item)"><i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete(item)" title="Xóa"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr ng-show="attributeValues.length == 0">
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
