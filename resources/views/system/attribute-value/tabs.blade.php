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
                        <label class="col-md-3 control-label">Bộ lọc</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-options="parent as parent.name for parent in parents track by parent.id" ng-model="attributeValue.attribute_id" tabindex="2" id="parentId">
                                <option value="">Chọn bộ lọc</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tên</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="attributeValue.content_value" tabindex="3"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->