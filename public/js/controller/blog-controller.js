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
system.controller("BlogController", BlogController);

/**
 * 
 * @param {type} $scope
 * @param {type} $http
 * @returns {undefined}
 */

function BlogController($scope, $rootScope, $http, $window, $timeout, Upload) {
    $scope.controllerName = "BlogController";
    $scope.blogs = [];
    $scope.uploadPath = '/upload/';
    $scope.isFinding = false;
    $scope.mode = '';
    $scope.formTitle = 'Tạo mới bài viết';
    $scope.filter = {};
    $scope.statuses = [{name: "Hiện", value: "active"}, {name: "Ẩn", value: "inactive"},{name: "Khuyến mãi", value: "sale"}];
    $scope.blog = {
        id: 0,
        title: '',
        slug: '',
        content: '',
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
    $scope.openDialogCreateOrUpdate = function (mode, blog) {
        $scope.openDialog(mode, blog);
    };
    $scope.openDialog = function (mode, blog) {
        $scope.mode = mode;
        tinyMCE.remove();
        $scope.reset(true);
        $('#description').val('');
        if (mode === 'update' || mode === 'detail') {
            $scope.formTitle = 'Sửa bài viết';
            $scope.blog = angular.copy(blog);
            $scope.blog.status = $scope.getByField($scope.statuses, "value", $scope.blog.status);
        }
        $timeout(function () {
            $scope.baseController.initTinymce("#description", 200, 0);
        });
    };


    $scope.reset = function (notResetFilter) {
        if (notResetFilter === null || typeof notResetFilter === 'undefined' || notResetFilter === false) {
            $scope.filter = {};
        }
        $scope.blog = {
            id: 0,
            title: '',
            slug: '',
            content: '',
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
        $scope.blog.slug = $scope.toFriendlyString($scope.blog.title);
    };
    /**
     * Lưu thông tin danh mục - create or update
     * @returns {undefined}
     */
    $scope.save = function () {
        $('.save').button('loading');
        if ($scope.blog.title === '') {
            $('.save').button('reset');
            showMessage('Error', "Tên không được bỏ trống", 'error', 'glyphicon-remove');
            return;
        }
        $scope.blog.status = $scope.blog.status.value;
        var description = tinyMCE.get('description').getContent();
        $scope.blog.content = description;
        if ($scope.blog.image != null && typeof $scope.blog.image == 'object') {
            Upload.upload({
                url: $scope.apiUrl + "/upload",
                file: $scope.blog.image
            }).error(function (data, status, headers, config) {
                console.log('error status: ' + status);
                console.log('error' + data);
            }).success(function (data) {
                if (data.status == 'successful') {
                    var relativePath = data.result;
                    $scope.blog.image = relativePath;
//                    $scope.blog.image = relativePath.replace(/^.*[\\\/]/, '');
                            var url = '/blog';
            var method = "POST";
            if ($scope.mode == "update"){
                url += "/"+$scope.blog.id;
                method = 'PATCH';
            }
            $scope.sendRequest(method, url, $scope.blog, function (data) {
                if (data.status == "fail") {
                    showMessage('Error', "Cập nhật thất bại " + data.message, 'error', 'glyphicon-remove');
                    $('.save').button('reset');
                } else {
                    $('.save').button('reset');
                    $scope.reset(true);
                    $scope.find();
                }
                $('#createManufacturer').modal('hide');
            },function(e){
                $scope.blog.status = $scope.getByField($scope.statuses,'value',$scope.blog.status );
                showErrors(e);
            });
                }
            });
        } else {
            var url = '/blog';
            var method = "POST";
            if ($scope.mode == "update"){
                url += "/"+$scope.blog.id;
                method = 'PATCH';
            }
            $scope.sendRequest(method, url, $scope.blog, function (data) {
                if (data.status == "fail") {
                    showMessage('Error', "Cập nhật thất bại " + data.message, 'error', 'glyphicon-remove');
                    $('.save').button('reset');
                } else {
                    $('.save').button('reset');
                    $scope.reset(true);
                    $scope.find();
                }
                $('#createManufacturer').modal('hide');
            },function(e){
                $scope.blog.status = $scope.getByField($scope.statuses,'value',$scope.blog.status );
                showErrors(e);
            });
        }
    };

    $scope.delete = function (item) {
        var yes = confirm("Bạn có thực sự muốn xóa \"" + item.title + "\"?");
        if (yes) {
            $http.delete($scope.apiUrl + "/blog/" + item.id).success(function (data) {
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

        $http.get($scope.apiUrl + "/blog" + buildFilter()).success(function (data) {
            $scope.hideLoading();
            if (data.status == "successful") {
                $scope.blogs = data.result;
                $scope.filter.pageId = data.meta.page_id;
                $scope.pagesCount = data.meta.page_count;
            }
        }).error(function () {
            $scope.hideLoading();
            alert("Không thể tải danh sách, vui lòng thử lại hoặc liên hệ bộ phận kỹ thuật để được hỗ trợ.");
        });
    };
    function buildFilter() {
        var retVal = '?';
        var dataFilter = {page_id: $scope.filter.pageId, page_size: 20, sort: '-sorder'};
        retVal += $scope.baseController.encodeQueryData(dataFilter);
        var filter = '';
        if ($scope.filter.title) {
            filter += 'title~' + $scope.filter.title + ',';
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
        if ($scope.blog.image != null) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(selectorShowImage).attr('src', e.target.result);
            };
            reader.readAsDataURL($scope.blog.image);
            $(selectorShowImage).show();
            $(selectorShowImage).removeClass('ng-hide');
        }

    };
}
    