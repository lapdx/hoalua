<!-- Custom Tabs -->
<div class="nav-tabs-custom" style="box-shadow: none">
<!--    <ul class="nav nav-tabs">
      <li class="active"><a href="#basic-tab" data-toggle="tab">Basic Information</a></li>
      <li><a href="#advanced-tab" data-toggle="tab">Advanced Information</a></li>
    </ul>-->
    <div class="tab-content">
        <div class="tab-pane active" id="basic-tab">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Loại</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-model="banner.type" tabindex="1" ng-options="item.name for item in types track by item.value"></select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Link</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="banner.link" tabindex="2"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-4">
                            <img id="image_demo" ng-show="banner.image_url != null" ng-src="@{{uploadPath + banner.image_url}}" style="max-width: 60px; max-height: 60px; display: block; margin: 1px;">
                            <input type="file" ng-change="showImageWhenChooseFile('#image_demo')" ng-model="banner.image_url"  ngf-select tabindex="10" accept="image/*" ngf-max-size="3MB" value="Select photo"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->