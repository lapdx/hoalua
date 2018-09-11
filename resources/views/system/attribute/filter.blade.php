<div class="row">
    <from class="form-horizontal">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-2">Tên: </label>
                <div class="col-md-10">
                    <input type="text" class="form-control" ng-model="keyword" ng-keypress="myEnter($event)" autofocus>
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