<div class="row">
    <from class="form-horizontal">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-md-2">Tên: </label>
                <div class="col-md-10">
                    <input type="text" class="form-control" ng-keyup="keypressFilter($event)" ng-model="filter.title" name="title" placeholder="Tên sản phẩm" autofocus>
                </div>
            </div>
        </div>
             <div class="col-md-3">
            <div class="form-group">
                <label class="control-label col-md-4">Khoảng giá: </label>
                <div class="col-md-8">
                    <input type="text" class="form-control" ng-model="filter.price_from">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label col-md-4">Đến: </label>
                <div class="col-md-8">
                    <input type="text" class="form-control" ng-model="filter.price_to">
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label col-md-5">Danh mục: </label>
                <div class="col-md-7">
                    <select ng-options="category as category.title for category in categories track by category.id" class="form-control select-two"  ng-model="filter.category" ng-change="find()">
                        <option value="">All</option>
                  </select>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-md-2">Mã: </label>
                <div class="col-md-10">
                    <input type="text" class="form-control" ng-model="filter.code" name="title" placeholder="Mã sản phẩm">
                </div>
            </div>
        </div>
   
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label col-md-4">Hãng sản xuất: </label>
                <div class="col-md-8">
                    <select ng-options="manufacturer as manufacturer.title for manufacturer in manufacturers track by manufacturer.id" class="form-control select-two"  ng-model="filter.manufacturer" ng-change="find()">
                        <option value="">All</option>
                  </select>
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
        <div class="col-md-2 text-center">
            <div class="form-group">
                <button type="button" class="btn btn-warning search" ng-click="find();" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i class="fa fa-search"></i> Search</button>
                <button type="button" class="btn btn-danger" ng-click="reset();"><i class="fa fa-times"></i> Clear</button>
            </div>
        </div>
    </from>
</div>