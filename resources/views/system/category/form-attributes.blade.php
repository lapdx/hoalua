<div class="modal fade" id="filterForm" role="dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" style="margin-top:10px;margin-bottom:10px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bộ lọc</h4>
            </div>
            <div class="modal-body no-padding">
                <form class="form-horizontal" role="form">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom" style="box-shadow: none">
                        <div class="tab-content">
                            <div class="tab-pane active" id="basic-tab">
                                <div class="row">
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Bộ lọc</label>
                                            <div class="col-md-9">
                                                <select multiple class="form-control js-multiple-select" ng-model="category.attributes" tabindex="1" ng-options="item.name for item in attributes track by item.id">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->
                </form>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary save" ng-click="saveAttributes()" tabindex="12" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Save</button>
            </div>
        </div>
    </div>
</div>