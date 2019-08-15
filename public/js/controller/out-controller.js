/**
 * Copyright (C) 2015, MEGAADS, JSC - All Rights Reserved
 *
 * This software is released under the terms of the proprietary license.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 * Proprietary and confidential.
 */

/**
 * @author Lap Dam
 */
system.requires.push('ngFileUpload');
system.controller("OutController", OutController);

/**
 * 
 * @param {type} $scope
 * @param {type} $http
 * @returns {undefined}
 */

function OutController($scope, $rootScope, $http, $window, $timeout, Upload) {
    $scope.controllerName = "OutController";
    $scope.inoutputs = [];
    $scope.inoutput = {};
    $scope.uploadPath = '/upload/';
    $scope.mode = '';
    $scope.filter = {};
    $scope.statuses = [{name: "Đang chờ", value: "pending"}, {name: "Đã xác nhận", value: "active"}];
    $scope.baseController = this.__proto__ = new BaseController($scope, $http, $rootScope);

    this.initialize = function ( ) {
    };
    this.initialize();
    $scope.openDialogCreateOrUpdate = function (mode, category) {
        $scope.openDialog(mode, category);
    };

    $scope.reset = function (notResetFilter) {
        $scope.isSaving = false;
        if (notResetFilter === null || typeof notResetFilter === 'undefined' || notResetFilter === false) {
            $scope.filter = {};
        }
        $scope.find();

    };
    /**
     * find data by filter
     * @returns {undefined}
     */
    $scope.find = function (isChangePageData) {
        $scope.showLoading();
        if (isChangePageData) {
            $scope.filter.pageId = 0;
        }

        $http.get($scope.apiUrl + "/inoutput" + buildFilter()).success(function (data) {
            $scope.hideLoading();
            if (data.status == "successful") {
                $scope.inoutputs = data.result;
                $scope.filter.page_id = data.meta.page_id;
                $scope.pagesCount = data.meta.page_count;
            }
        }).error(function () {
            $scope.hideLoading();
            alert("Không thể tải danh sách, vui lòng thử lại hoặc liên hệ bộ phận kỹ thuật để được hỗ trợ.");
        });
    };
    function buildFilter() {
        var retVal = '?embeds=inoutputItems&';
        var dataFilter = {page_id: $scope.filter.pageId, page_size: 20, sort: '-sorder'};
        retVal += $scope.baseController.encodeQueryData(dataFilter);
        var filter = '';
        if ($scope.filter.keywords) {
            filter += 'search~' + $scope.toFriendlyString($scope.filter.keywords) + ',';
        }
        if ($scope.filter.status) {
            filter += 'status=' + $scope.filter.status.value + ',';
        }
        if (filter != '') {
            retVal += '&filters=' + filter;
        }
        return retVal;
    }
    $scope.changeStatus = function (item) {
        $scope.inoutput.id = item.id;
        $scope.inoutput.code = item.code;
        $scope.inoutput.status = $scope.getByField($scope.statuses, 'value', item.status);
        $('#changeStatus').modal('show');
    }
    $scope.saveStatus = function () {
        $scope.inoutput.status = $scope.inoutput.status.value;
        $scope.sendRequest("PATCH", "/inoutput/" + $scope.inoutput.id, $scope.inoutput, function (data) {
            if (data.status == "fail") {
                showMessage('Error', "Cập nhật thất bại " + data.message, 'error', 'glyphicon-remove');
                $('.save-status').button('reset');
            } else {
                $('.save-status').button('reset');
                $scope.inoutput = {};
                $scope.find();
            }
            $('#changeStatus').modal('hide');
        }, function (e) {
            $scope.blog.status = $scope.getByField($scope.statuses, 'value', $scope.blog.status);
            showErrors(e);
        });
    }
    $scope.find();
    /**
     * 
     * @param {type} event
     * @returns {undefined}
     */
    $scope.keypressFilter = function (event) {
        if (event.keyCode === 13) {
            $scope.find(true);
        }
    };
}
    