<!-- Custom Tabs -->
<div class="nav-tabs-custom" style="box-shadow: none">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#basic-tab" data-toggle="tab">Basic Information</a></li>
        <li><a href="#advanced-tab" data-toggle="tab">Advanced Information</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="basic-tab">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Trạng thái</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-model="product.status" tabindex="1" ng-options="item.name for item in statuses track by item.value"></select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Thứ tự</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="product.sorder" tabindex="2"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tên</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="product.title" tabindex="3" ng-change="onTitleChange()"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Slug</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" ng-model="product.slug" tabindex="4"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Giá NCC</label>
                        <div class="col-md-9">
                            <input type="text" awnum="price" class="form-control" ng-model="product.price" tabindex="5"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Giá bán</label>
                        <div class="col-md-9">
                            <input type="text" awnum="price" class="form-control" ng-model="product.sale_price" tabindex="6"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Hãng</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-model="product.manufacturer" tabindex="7" ng-options="manufacturer as manufacturer.title for manufacturer in manufacturers track by manufacturer.id">
                                <option value="">Chọn</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Danh mục</label>
                        <div class="col-md-9">
                            <select class="form-control" ng-model="product.category" tabindex="8" ng-options="category as category.title for category in categories track by category.id">
                                <option value="">Chọn</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-4">
                            <img id="image_demo" ng-show="product.image_url!= null" ng-src="@{{uploadPath + product.image_url }}" style="max-width: 60px; max-height: 60px; display: block; margin: 1px;">
                            <input type="file" ng-change="showImageWhenChooseFile('#image_demo')" ng-model="product.image"  ngf-select tabindex="9" accept="image/*" ngf-max-size="3MB" value="Select photo"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-1 control-label">Mô tả<br />
                        </label>
                        <div class="col-md-11">
                            <textarea rows="3" class="form-control" ng-model="product.content" tabindex="10" id="description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="advanced-tab">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Title<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="product.meta_title" tabindex="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Description<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="product.meta_description" tabindex="7"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Keyword<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="product.meta_keywords" tabindex="8"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description<br />
                        </label>
                        <div class="col-md-9">
                            <textarea rows="3" class="form-control" ng-model="product.description" tabindex="9"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.tab-content -->
</div><!-- nav-tabs-custom -->