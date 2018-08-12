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
system.controller("EmailController", EmailController);

/**
 * 
 * @param {type} $scope
 * @param {type} $http
 * @returns {undefined}
 */

function EmailController($scope, $rootScope, $http, $window, $timeout, Upload) {
    $scope.controllerName = "EmailController";
    $scope.emails = [];
    $scope.uploadPath = '/upload/';
    $scope.isFinding = false;
    $scope.mode = '';
    $scope.formTitle = 'Tạo mới bài viết';
    $scope.filter = {};
    $scope.statuses = [{name: "Hiện", value: "active"}, {name: "Ẩn", value: "inactive"}];
    $scope.email = {
        id: 0,
        email: ''
    };
    $scope.baseController = this.__proto__ = new BaseController($scope, $http, $rootScope);

    this.initialize = function ( ) {
    };
    this.initialize();
    $scope.openDialogCreateOrUpdate = function (mode, email) {
        $scope.openDialog(mode, email);
    };
    $scope.openDialog = function (mode, email) {
        $scope.mode = mode;
        tinyMCE.remove();
        $scope.reset(true);
        if (mode === 'update' || mode === 'detail') {
            $scope.formTitle = 'Sửa bài viết';
            $scope.email = angular.copy(email);
            $scope.email.status = $scope.getByField($scope.statuses, "value", $scope.email.status);
        }
        $timeout(function () {
            $scope.baseController.initTinymce("#description", 200, 0);
        });
    };


    $scope.reset = function (notResetFilter) {
        if (notResetFilter === null || typeof notResetFilter === 'undefined' || notResetFilter === false) {
            $scope.filter = {};
        }
        $scope.email = {
            id: 0,
            email: ''
        };
        $scope.find();

    };
    $scope.onTitleChange = function () {
        $scope.email.slug = $scope.toFriendlyString($scope.email.title);
    };
    /**
     * Lưu thông tin danh mục - create or update
     * @returns {undefined}
     */
    $scope.save = function () {
        $('.save').button('loading');
        if ($scope.email.title === '') {
            $('.save').button('reset');
            showMessage('Error', "Tên không được bỏ trống", 'error', 'glyphicon-remove');
            return;
        }
        $scope.email.status = $scope.email.status.value;
        var description = tinyMCE.get('description').getContent();
        $scope.email.content = description;
        if ($scope.email.image != null && typeof $scope.email.image == 'object') {
            Upload.upload({
                url: $scope.apiUrl + "/upload",
                file: $scope.email.image
            }).error(function (data, status, headers, config) {
                console.log('error status: ' + status);
                console.log('error' + data);
            }).success(function (data) {
                if (data.status == 'successful') {
                    var relativePath = data.result;
                    $scope.email.image = relativePath;
//                    $scope.email.image = relativePath.replace(/^.*[\\\/]/, '');
                    if ($scope.mode == "update") {
                        $http.patch($scope.apiUrl + '/email_newsletter/' + $scope.email.id, $scope.email).success(function (data) {
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
                        $http.post($scope.apiUrl + '/email_newsletter', $scope.email).success(function (data) {
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
                $http.patch($scope.apiUrl + '/email_newsletter/' + $scope.email.id, $scope.email).success(function (data) {
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
                $http.post($scope.apiUrl + '/email_newsletter', $scope.email).success(function (data) {
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

    $scope.delete = function (item) {
        var yes = confirm("Bạn có thực sự muốn xóa \"" + item.email + "\"?");
        if (yes) {
            $http.delete($scope.apiUrl + "/email_newsletter/" + item.id).success(function (data) {
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
        $scope.showLoading();
        if (isChangePageData) {
            $scope.filter.pageId = 0;
        }

        $http.get($scope.apiUrl + "/email_newsletter" + buildFilter()).success(function (data) {
            $scope.hideLoading();
            if (data.status == "successful") {
                $scope.emails = data.result;
                $scope.filter.page_id = data.meta.page_id;
                $scope.pagesCount = data.page_count;
            }
        }).error(function () {
            $scope.hideLoading();
            alert("Không thể tải danh sách, vui lòng thử lại hoặc liên hệ bộ phận kỹ thuật để được hỗ trợ.");
        });
    };
    function buildFilter() {
        var retVal = '?';
        var dataFilter = {page_id: $scope.filter.pageId, page_size: 20, sort: '-id'};
        retVal += $scope.baseController.encodeQueryData(dataFilter);
        var filter = '';
        if ($scope.filter.title) {
            filter += 'email~' + $scope.filter.title + ',';
        }
        if ($scope.filter.status) {
            filter += 'status=' + $scope.filter.status.value + ',';
        }
        if ($scope.filter.type) {
            filter += 'type=' + $scope.filter.type.value + ',';
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
    $scope.showImageWhenChooseFile = function (selectorShowImage) {
        if ($scope.email.image != null) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(selectorShowImage).attr('src', e.target.result);
            };
            reader.readAsDataURL($scope.email.image);
            $(selectorShowImage).show();
            $(selectorShowImage).removeClass('ng-hide');
        }

    };
}
    