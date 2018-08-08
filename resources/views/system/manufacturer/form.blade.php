<div class="modal fade" id="createManufacturer" role="dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document" style="margin-top:10px;margin-bottom:10px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@{{formTitle}}</h4>
            </div>
            <div class="modal-body no-padding">
                <form class="form-horizontal" role="form">
                    @include('system.manufacturer.tabs')
                </form>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary save" ng-click="save()" tabindex="12" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Save</button>
            </div>
        </div>
    </div>
</div>