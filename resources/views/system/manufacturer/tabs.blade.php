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
                        <label class="col-md-3 control-label">Trạng thái</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-model="manufacture.status" tabindex="1" ng-options="item.name for item in statuses track by item.value"></select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Thứ tự</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="manufacture.sorder" tabindex="2"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tên</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="manufacture.title" tabindex="2" ng-change="onTitleChange()"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Slug</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="manufacture.slug" tabindex="3"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mô tả<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="manufacture.description" tabindex="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Title<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="manufacture.meta_title" tabindex="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Description<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="manufacture.meta_description" tabindex="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Keyword<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="manufacture.meta_keywords" tabindex="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-4">
                            <img id="image_demo" ng-show="manufacture.image_url != null" ng-src="@{{uploadPath + manufacture.image_url}}" style="max-width: 60px; max-height: 60px; display: block; margin: 1px;">
                            <input type="file" ng-change="showImageWhenChooseFile('#image_demo')" ng-model="manufacture.image_url"  ngf-select tabindex="10" accept="image/*" ngf-max-size="3MB" value="Select photo"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->