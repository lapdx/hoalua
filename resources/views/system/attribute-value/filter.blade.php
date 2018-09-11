<div class="row">
    <from class="form-horizontal">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label col-md-2">Tên: </label>
                <div class="col-md-10">
                    <input type="text" class="form-control" ng-keyup="keypressFilter($event)" ng-model="filter.content_value" name="title" placeholder="Tên thuộc tính" autofocus>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-md-4">Bộ lọc: </label>
                <div class="col-md-8">
                    <select class="form-control" ng-model="filter.parent_id" ng-options="parent as parent.name for parent in parents track by parent.id" ng-change="find()">
                         <option value="">Chọn bộ lọc</option>
                    </select>
                </div>
            </div>
        </div>
<!--        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label col-md-4">Trạng thái: </label>
                <div class="col-md-8">
                    <select ng-options="status as status.name for status in statuses track by status.value" class="form-control"  ng-model="filter.status" ng-change="find()">
                        <option value="">All</option>
                  </select>
                </div>
            </div>
        </div>-->
<!--        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label col-md-4">Loại: </label>
                <div class="col-md-8">
                    <select ng-options="type as type.name for type in types track by type.value" class="form-control"  ng-model="filter.type" ng-change="find()">
                        <option value="">All</option>
                  </select>
                </div>
            </div>
        </div>-->
        <div class="col-md-3 text-center">
            <div class="form-group">
                <button type="button" class="btn btn-warning search" ng-click="find();" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i class="fa fa-search"></i> Search</button>
                <button type="button" class="btn btn-danger" ng-click="reset();"><i class="fa fa-times"></i> Clear</button>
            </div>
        </div>
    </from>
</div>