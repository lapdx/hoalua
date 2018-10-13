<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Banner</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm" ng-click="openDialogCreateOrUpdate('create',null)" data-toggle="modal" data-target="#createManufacturer">
                        <i class="fa fa-plus"></i> Tạo mới
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover" ng-cloak>
                            <thead>
                                <tr role="row">
                                    <th class="col-md-2 text-center vertical-align">Ảnh</th>
                                    <th class="col-md-2 text-center vertical-align">Link</th>
                                    <th class="col-md-2 text-center vertical-align">Loại</th>
                                    <th class="col-md-2 text-center vertical-align">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in banners track by $index">
                                    <td>
                                        <span><img src="@{{uploadPath + item.image_url}}" style="max-width: 50px;max-height: 50px"/></span>
                                    </td>
                                    <td>
                                        <span>@{{item.link}}</span>
                                    </td>
                                    <td class="text-center vertical-align">
                                       <span class="label label-primary cursor">@{{getByField(types,'value',item.type).name}}</span>
                                    </td>
                                    <td class="text-center vertical-align">
                                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete($index)" title="Xóa"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr ng-show="banners.length == 0">
                                    <td colspan="4">No data...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
