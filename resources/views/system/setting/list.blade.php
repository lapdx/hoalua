<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Cài đặt</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('system.setting.filter')
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover" ng-cloak>
                            <thead>
                                <tr role="row">
                                    <th class="col-md-3 text-center vertical-align">Key</th>
                                    <th class="col-md-3 text-center vertical-align">Value</th>
                                    <th class="col-md-2 text-center vertical-align">Mô tả</th>
                                    <th class="col-md-2 text-center vertical-align">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: antiquewhite">
                                    <td><input class="form-control" ng-model="newParam.param_key" style="width: 95%" type="text"/></td>
                                    <td class="w-320"><input class="form-control" ng-model="newParam.param_value" style="width: 95%" type="text"/></td>
                                    <td><textarea class="form-control" ng-model="newParam.description" style="width: 95%" rows="2"></textarea></td>
                                    <td class="text-center vertical-align"><button type="button" class="btn btn-sm btn-info" title="Lưu" ng-click="add()"><i class="fa fa-save"></i></button></td>
                                </tr>  
                                <tr ng-repeat="item in params track by $index">
                                    <td>
                                        <span ng-show="!item['edit']">@{{item.param_key}}</span>
                                        <input class="form-control" ng-show="item['edit']" ng-model="item.param_key" style="width: 95%" type="text"/>
                                    </td>
                                    <td>
                                        <span ng-show="!item['edit']">@{{item.param_value}}</span>
                                        <input class="form-control" ng-show="item['edit']" ng-model="item.param_value" style="width: 95%" type="text"/>
                                    </td>
                                    <td class="text-center vertical-align">
                                        <span ng-show="!item['edit']">@{{item.description}}</span>
                                        <textarea class="form-control" ng-show="item['edit']" ng-model="item.description" style="width: 95%" rows="2"></textarea>
                                    </td>
                                    <td class="text-center vertical-align">
                                        <button type="button" class="btn btn-sm btn-info" title="Sửa" ng-show="!item['edit']" ng-click="showUpdate(item)"><i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" ng-show="!item['edit']" ng-click="delete(item)" title="Xóa"><i class="fa fa-trash"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" ng-show="item['edit']" ng-click="update(item)"  title="Lưu"><i class="fa fa-save"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" ng-show="item['edit']" ng-click="cancelUpdate(item)" title="Hủy"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>
                                <tr ng-show="params.length == 0">
                                    <td colspan="4">No data...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--@include('system.layouts.inc.paginator', ["accessPageId" => "pageId", "accessPagesCount" => "pagesCount", "accessFind" => "find(null)"])-->
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
