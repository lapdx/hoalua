<div class="row">
    <from class="form-horizontal">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-md-4">Từ khóa: </label>
                <div class="col-md-8">
                    <input type="text" class="form-control" ng-keyup="keypressFilter($event)" ng-model="filter.keywords" name="title" placeholder="Tên danh mục" autofocus>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label col-md-4">Trạng thái: </label>
                <div class="col-md-8">
                    <select ng-options="status as status.name for status in statuses track by status.value" class="form-control"  ng-model="filter.status" ng-change="find()">
                        <option value="">All</option>
                  </select>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <div class="form-group">
                <button type="button" class="btn btn-warning search" ng-click="find();" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i class="fa fa-search"></i> Search</button>
                <button type="button" class="btn btn-danger" ng-click="reset();"><i class="fa fa-times"></i> Clear</button>
            </div>
        </div>
    </from>
</div>