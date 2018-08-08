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
                            <select class="form-control" ng-model="category.status" tabindex="1" ng-options="item.name for item in statuses track by item.value"></select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Danh mục cha</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-options="parent as parent.title for parent in parents track by parent.id" ng-model="category.parent_id" tabindex="2" id="parentId">
                                <option value="">Chọn danh mục</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tên</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="category.title" tabindex="3" ng-change="onTitleChange()"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Slug</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="category.slug" tabindex="4"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mô tả<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="category.description" tabindex="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Title<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="category.meta_title" tabindex="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Description<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="category.meta_description" tabindex="7"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Keyword<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="category.meta_keywords" tabindex="8"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Thứ tự</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="category.sorder" tabindex="9"/>
                        </div>
                    </div>
                </div>
<!--                 <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Loại</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-model="category.type" tabindex="10" ng-options="item.name for item in types track by item.value"></select>
                        </div>
                    </div>
                </div>-->
            </div>
        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->