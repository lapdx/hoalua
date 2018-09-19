<div class="modal fade" id="galleryForm" role="dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" style="margin-top:10px;margin-bottom:10px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thư viện ảnh</h4>
            </div>
            <div class="modal-body no-padding">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-bordered table-hover" ng-cloak>
                                            <thead>
                                                <tr role="row">
                                                    <th class="text-center vertical-align">Ảnh</th>
                                                    <th class="col-md-2 text-center vertical-align">Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in product.images track by $index">
                                                    <td>
                                                        <span ng-show="item.image_url != null"><img src="@{{uploadPath + item.image_url}}" style="max-width: 50px;max-height: 50px"/></span>
                                                    </td>

                                                    <td class="text-center vertical-align">
                                                        <button type="button" class="btn btn-danger btn-sm" ng-click="deleteImage(item)" title="Xóa"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" ngf-select="uploadFiles($file, $invalidFiles)" tabindex="10" accept="image/*" ngf-max-size="3MB"><i class="fa fa-picture-o"></i> Select photo</button>
            </div>
        </div>
    </div>
</div>