
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
system.controller("AttributeValueController", AttributeValueController);

/**
 * 
 * @param {type} $scope
 * @param {type} $http
 * @returns {undefined}
 */

function AttributeValueController($scope, $rootScope, $http, $window, $timeout, Upload) {
    $scope.controllerName = "AttributeValueController";
    $scope.attributeValues = [];
    $scope.parents = [];
    $scope.uploadPath = '/upload/';
    $scope.isFinding = false;
    $scope.mode = '';
    $scope.formTitle = 'Tạo mới thuộc tính';
    $scope.filter = {};
    $scope.statuses = [{name: "Hiện", value: "active"}, {name: "Ẩn", value: "inactive"}];
    $scope.types = [{name: "Category", value: "category"}, {name: "Blog", value: "blog"}];
    $scope.attributeValue = {
        id: 0,
        attribute_id: 0,
        content_value: '',
    };
    $scope.baseController = this.__proto__ = new BaseController($scope, $http, $rootScope);

    this.initialize = function ( ) {
//        $("#parentId, #parentFilterId").select2({
//        allowClear: true,
//        placeholder: "-- Chọn Danh Mục --",
//        tags: true,
//		ajax: {
//			url: $scope.apiUrl + "/attribute_values" + buildFilter(true),
//			dataType: 'json',
//			delay: 250,
//			sorter: false,
//			data: function (params) {
//				return {
//                    name: params.term
//				};
//            },
//            beforeSend: function (xhr) {
//                xhr.setRequestHeader ("Authorization", "Basic YXBpOnRyYW5kdW9uZ0AyMzc=");
////                var params = new URL(window.location.origin + settings.url);
////                var check = params.searchParams.get("name");
////                if(typeof(check) == 'undefined' || check == '' || check == null) {
////                    return false;
////                }
//            },
//			processResults: function (data, params) {
//				return {
//					results: $.map(data.data, function (item) {
//						return {
//							text: item.title,
//							id: item.id
//						}
//					})
//				};
//			},
//			cache: true
//		}
//    });
                $http.get($scope.apiUrl + "/attributes?page_id=0&page_size=200").success(function (data) {
            if (data.status == "successful") {
                $scope.parents = data.result;
//                $scope.filter.page_id = data.meta.page_id;
//                $scope.pagesCount = data.page_count;
            }
        }).error(function () {
        });
    };
    this.initialize();
    $scope.openDialogCreateOrUpdate = function (mode, attributeValue) {
        $scope.openDialog(mode, attributeValue);
    };
    $scope.openDialog = function (mode, attributeValue) {
        $scope.mode = mode;
        $scope.reset(true);
        if (mode === 'update' || mode === 'detail') {
            $scope.formTitle = 'Sửa thuộc tính';
            $scope.attributeValue = angular.copy(attributeValue);
            $scope.attributeValue.attribute_id = $scope.getByField($scope.parents, "id", $scope.attributeValue.attribute_id);
        }
//        $timeout(function () {
//            $scope.baseController.initTinymce("#description", 200, 0);
//        });
    };


    $scope.reset = function (notResetFilter) {
        $scope.isSaving = false;
        if (notResetFilter === null || typeof notResetFilter === 'undefined' || notResetFilter === false) {
            $scope.filter = {};
        }
        $scope.isFinding = false;
        $scope.attributeValue = {
        id: 0,
        attribute_id: 0,
        content_value: ''
    };
        $scope.find();

    };
//    $scope.onTitleChange = function () {
//        $scope.attributeValue.slug = $scope.toFriendlyString($scope.attributeValue.title);
//    };
    /**
     * Lưu thông tin danh mục - create or update
     * @returns {undefined}
     */
    $scope.save = function () {
        $('.save').button('loading');
        if ($scope.attributeValue.name === '') {
            $('.save').button('reset');
            showMessage('Error', "Tên không được bỏ trống", 'error', 'glyphicon-remove');
            return;
        }
        if ($scope.attributeValue.attribute_id) {
            $scope.attributeValue.attribute_id = $scope.attributeValue.attribute_id.id;
        }
        if ($scope.mode == "update") {
                $http.patch($scope.apiUrl + '/attribute_values/' + $scope.attributeValue.id, $scope.attributeValue).success(function (data) {
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
                $http.post($scope.apiUrl + '/attribute_values', $scope.attributeValue).success(function (data) {
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
    };

    $scope.delete = function (item) {
        var yes = confirm("Bạn có thực sự muốn xóa \"" + item.name + "\"?");
        if (yes) {
            $http.delete($scope.apiUrl + "/attribute_values/" + item.id).success(function (data) {
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

        $http.get($scope.apiUrl + "/attribute_values" + buildFilter()).success(function (data) {
            $scope.hideLoading();
            if (data.status == "successful") {
                $scope.attributeValues = data.result;
                $scope.filter.page_id = data.meta.page_id;
                $scope.pagesCount = data.page_count;
            }
        }).error(function () {
            $scope.hideLoading();
            alert("Không thể tải danh sách, vui lòng thử lại hoặc liên hệ bộ phận kỹ thuật để được hỗ trợ.");
        });
    };
    function buildFilter(isParent) {
        var retVal = '?';
        var dataFilter = {page_id: $scope.filter.pageId, page_size: isParent?10000:20, sort: '-sorder'};
        retVal += $scope.baseController.encodeQueryData(dataFilter);
        var filter = '';
        if ($scope.filter.content_value) {
            filter += 'content_value~' + $scope.filter.content_value + ',';
        }
        if ($scope.filter.attribute_id) {
            filter += 'attribute_id=' + $scope.filter.attribute_id.id + ',';
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
}
    