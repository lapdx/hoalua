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
system.controller("ManufacturerController", ManufacturerController);

/**
 * 
 * @param {type} $scope
 * @param {type} $http
 * @returns {undefined}
 */

function ManufacturerController($scope, $rootScope, $http, $window, $timeout, Upload) {
    $scope.controllerName = "ManufacturerController";
    $scope.manufactures = [];
    $scope.uploadPath = '/upload/';
    $scope.failMessage = "";
    $scope.isFinding = true;
    $scope.mode = '';
    $scope.formTitle = 'Tạo mới hãng sản xuất';
    $scope.manufacturerInputSave = '';
    $scope.filter = {};
    $scope.statuses = [{name: "Hiện", value: "active"}, {name: "Ẩn", value: "inactive"}];
    $scope.manufacture = {
        id: 0,
        title: '',
        slug: '',
        description: '',
        meta_title: '',
        meta_description: '',
        meta_keywords: '',
        sorder: 0,
        status: {name: "Hiện", value: "active"}
    };
    $scope.baseController = this.__proto__ = new BaseController($scope, $http, $rootScope);

    this.initialize = function ( ) {
    };
    this.initialize();
    $scope.openDialogCreateOrUpdate = function (mode, manufacture) {
        $scope.openDialog(mode, manufacture);
    };
    $scope.openDialog = function (mode, manufacture) {
        $scope.mode = mode;
        $scope.formTitle = 'Tạo mới hãng sản xuất';
        $scope.reset(true);
        if (mode === 'update' || mode === 'detail') {
            $scope.formTitle = 'Sửa hãng sản xuất';
            $scope.reset(true);
            $scope.manufacture = angular.copy(manufacture);
            $scope.manufacture.status = $scope.getByField($scope.statuses, "value", $scope.manufacture.status);
        }
        $scope.isSaving = false;
        $scope.isFinding = false;
    };


    $scope.reset = function (notResetFilter) {
        $scope.isSaving = false;
        if (notResetFilter === null || typeof notResetFilter === 'undefined' || notResetFilter === false) {
            $scope.filter = {};
        }
        $scope.manufacturersMerge = [];
        $scope.manufacturerInto = {};
        $scope.isFinding = false;
        $scope.manufacture = {
            id: 0,
            title: '',
            slug: '',
            description: '',
            meta_title: '',
            meta_description: '',
            meta_keywords: '',
            sorder: 0,
            status: {name: "Hiện", value: "active"}
        };
        $scope.find();

    };
    $scope.onTitleChange = function () {
        $scope.manufacture.slug = $scope.toFriendlyString($scope.manufacture.title);
    };
    /**
     * Lưu thông tin danh mục - create or update
     * @returns {undefined}
     */
    $scope.save = function () {
        $('.save').button('loading');
        if ($scope.manufacture.title === '') {
            $('.save').button('reset');
            showMessage('Error', "Tên không được bỏ trống", 'error', 'glyphicon-remove');
            return;
        }
        $scope.manufacture.status = $scope.manufacture.status.value;
        if ($scope.manufacture.image_url != null && typeof $scope.manufacture.image_url == 'object') {
            Upload.upload({
                url: $scope.apiUrl + "/upload",
                file: $scope.manufacture.image_url
            }).error(function (data, status, headers, config) {
                console.log('error status: ' + status);
                console.log('error' + data);
            }).success(function (data) {
                if (data.status == 'successful') {
                    var relativePath = data.result;
                    $scope.manufacture.image_url = relativePath;
//                    $scope.manufacture.image_url = relativePath.replace(/^.*[\\\/]/, '');
                    if ($scope.mode == "update") {
                        $http.patch($scope.apiUrl + '/manufacturer/' + $scope.manufacture.id, $scope.manufacture).success(function (data) {
                            if (data.status == "fail") {
                                showMessage('Error', "Cập nhật thất bại " + data.message, 'error', 'glyphicon-remove');
                                $('.save').button('reset');
                            } else {
                                $('.save').button('reset');
                                $scope.reset(true);
                                $scope.find();
                            }
                            $('#createManufacturer').modal('hide');

                        });
                    } else {
                        $http.post($scope.apiUrl + '/manufacturer', $scope.manufacture).success(function (data) {
                            if (data.status == "fail") {
                                showMessage('Error', "Thêm mới thất bại " + data.message, 'error', 'glyphicon-remove');
                                $('.save').button('reset');
                            } else {
                                $('.save').button('reset');
                                $scope.reset(true);
                                $scope.find();
                            }
                            $('#createManufacturer').modal('hide');
                        });
                    }
                }
            });
        } else {
            if ($scope.mode == "update") {
                $http.patch($scope.apiUrl + '/manufacturer/' + $scope.manufacture.id, $scope.manufacture).success(function (data) {
                    if (data.status == "fail") {
                        showMessage('Error', "Cập nhật thất bại " + data.message, 'error', 'glyphicon-remove');
                        $('.save').button('reset');
                    } else {
                        $('.save').button('reset');
                        $scope.reset(true);
                        $scope.find();
                    }
                    $('#createManufacturer').modal('hide');

                });
            } else {
                $http.post($scope.apiUrl + '/manufacturer', $scope.manufacture).success(function (data) {
                    if (data.status == "fail") {
                        showMessage('Error', "Thêm mới thất bại " + data.message, 'error', 'glyphicon-remove');
                        $('.save').button('reset');
                    } else {
                        $('.save').button('reset');
                        $scope.reset(true);
                        $scope.find();
                    }
                    $('#createManufacturer').modal('hide');
                });
            }
        }
    };

    $scope.delete = function (manufacture) {
        var yes = confirm("Bạn có thực sự muốn xóa \"" + manufacture.title + "\"?");
        if (yes) {
            $http.delete($scope.apiUrl + "/manufacturer/" + manufacture.id).success(function (data) {
                if (data.status === "successful") {
                    $scope.reset();
                    $scope.find(true);
                } else {
                    alert(data.message);
                    return;
                }
            });
        }
    };

    /**
     * find data by filter
     * @returns {undefined}
     */
    $scope.find = function (isChangePageData) {
        $scope.isFinding = true;
        $scope.showLoading();
        if (isChangePageData) {
            $scope.filter.pageId = 0;
        }

        $http.get($scope.apiUrl + "/manufacturer" + buildFilter()).success(function (data) {
            $scope.hideLoading();
            $scope.isFinding = false;
            if (data.status == "successful") {
                $scope.manufactures = data.result;
                $scope.filter.page_id = data.meta.page_id;
                $scope.pagesCount = data.page_count;
            }
        }).error(function () {
            $scope.hideLoading();
            alert("Không thể tải danh sách, vui lòng thử lại hoặc liên hệ bộ phận kỹ thuật để được hỗ trợ.");
            $scope.isSaving = false;
        });
    };
    function buildFilter() {
        var retVal = '?';
        var dataFilter = {page_id: $scope.filter.pageId, page_size: 20, sorts: '-sorder'};
        retVal += $scope.baseController.encodeQueryData(dataFilter);
        var filter = '';
        if ($scope.filter.title) {
            filter += 'title~' + $scope.filter.title + ',';
        }
        if ($scope.filter.status) {
            filter += 'status=' + $scope.filter.status.value + ',';
        }
        if (filter != '') {
            retVal += '&filters=' + filter;
        }
        return retVal;
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
    /**
     * 
     * @param {type} inputFile
     * @param {type} selectorShowImage
     * @returns {undefined}
     */
    $scope.showImageWhenChooseFile = function (selectorShowImage) {
        if ($scope.manufacture.image_url != null) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(selectorShowImage).attr('src', e.target.result);
            };
            reader.readAsDataURL($scope.manufacture.image_url);
            $(selectorShowImage).show();
            $(selectorShowImage).removeClass('ng-hide');
        }

    };
}
    