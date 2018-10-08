<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Menu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover" ng-cloak>
                            <thead>
                                <tr role="row">
                                    <th class="col-md-3 text-center vertical-align">Text</th>
                                    <th class="col-md-4 text-center vertical-align">Link</th>
                                    <th class="col-md-3 text-center vertical-align">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background-color: antiquewhite">
                                    <td><input class="form-control" ng-model="menu.text" style="width: 95%" type="text"/></td>
                                    <td class="w-320"><input class="form-control" ng-model="menu.link" style="width: 95%" type="text"/></td>
                                    <td class="text-center vertical-align"><button type="button" class="btn btn-sm btn-info" title="Lưu" ng-click="push(menu, menus)"><i class="fa fa-save"></i></button></td>
                                </tr>  
                                <tr ng-repeat="item in menus track by $index">
                                    <td>
                                        <span ng-show="!item['edit']">@{{item.text}}</span>
                                        <input class="form-control" ng-show="item['edit']" ng-model="item.text" style="width: 95%" type="text"/>
                                    </td>
                                    <td>
                                        <span ng-show="!item['edit']">@{{item.link}}</span>
                                        <input class="form-control" ng-show="item['edit']" ng-model="item.link" style="width: 95%" type="text"/>
                                    </td>
                                    <td class="text-center vertical-align">
                                        <button type="button" class="btn btn-danger btn-sm" ng-show="!item['edit']" ng-click="remove($index,menus)" title="Xóa"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr ng-show="menus.length == 0">
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
