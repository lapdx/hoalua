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
system.controller("CategoryController", CategoryController);

/**
 * 
 * @param {type} $scope
 * @param {type} $http
 * @returns {undefined}
 */

function CategoryController($scope, $rootScope, $http, $window, $timeout, Upload) {
    $scope.controllerName = "CategoryController";
    $scope.categories = [];
    $scope.parents = [];
    $scope.uploadPath = '/upload/';
    $scope.isFinding = false;
    $scope.mode = '';
    $scope.formTitle = 'Tạo mới danh mục';
    $scope.filter = {};
    $scope.statuses = [{name: "Hiện", value: "active"}, {name: "Ẩn", value: "inactive"}];
    $scope.types = [{name: "Category", value: "category"}, {name: "Blog", value: "blog"}];
    $scope.category = {
        id: 0,
        parent_id: 0,
        left_value: 0,
        right_value: 0,
        title: '',
        slug: '',
        type: {name: "Category", value: "category"},
        description: '',
        meta_title: '',
        meta_description: '',
        meta_keywords: '',
        sorder: 0,
        status: {name: "Hiện", value: "active"}
    };
    $scope.baseController = this.__proto__ = new BaseController($scope, $http, $rootScope);

    this.initialize = function ( ) {
//        $("#parentId, #parentFilterId").select2({
//        allowClear: true,
//        placeholder: "-- Chọn Danh Mục --",
//        tags: true,
//		ajax: {
//			url: $scope.apiUrl + "/category" + buildFilter(true),
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
                $http.get($scope.apiUrl + "/category" + buildFilter(1)).success(function (data) {
            if (data.status == "successful") {
                $scope.parents = data.result;
//                $scope.filter.page_id = data.meta.page_id;
//                $scope.pagesCount = data.page_count;
            }
        }).error(function () {
        });
    };
    this.initialize();
    $scope.openDialogCreateOrUpdate = function (mode, category) {
        $scope.openDialog(mode, category);
    };
    $scope.openDialog = function (mode, category) {
        $scope.mode = mode;
        tinyMCE.remove();
        $scope.reset(true);
        if (mode === 'update' || mode === 'detail') {
            $scope.formTitle = 'Sửa danh mục';
            $scope.category = angular.copy(category);
            $scope.category.status = $scope.getByField($scope.statuses, "value", $scope.category.status);
            $scope.category.parent_id = $scope.getByField($scope.parents, "id", $scope.category.parent_id);
        }
        $timeout(function () {
            $scope.baseController.initTinymce("#description", 200, 0);
        });
    };


    $scope.reset = function (notResetFilter) {
        $scope.isSaving = false;
        if (notResetFilter === null || typeof notResetFilter === 'undefined' || notResetFilter === false) {
            $scope.filter = {};
        }
        $scope.isFinding = false;
        $scope.category = {
             id: 0,
        parent_id: 0,
        left_value: 0,
        right_value: 0,
        title: '',
        slug: '',
        type: {name: "Category", value: "category"},
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
        $scope.category.slug = $scope.toFriendlyString($scope.category.title);
    };
    /**
     * Lưu thông tin danh mục - create or update
     * @returns {undefined}
     */
    $scope.save = function () {
        $('.save').button('loading');
        if ($scope.category.title === '') {
            $('.save').button('reset');
            showMessage('Error', "Tên không được bỏ trống", 'error', 'glyphicon-remove');
            return;
        }
        $scope.category.status = $scope.category.status.value;
        if ($scope.category.parent_id) {
            $scope.category.parent_id = $scope.category.parent_id.id;
        }
        if ($scope.category.type) {
            $scope.category.type = $scope.category.type.value;
        }
        var description = tinyMCE.get('description').getContent();
        $scope.category.description = description;
        if ($scope.mode == "update") {
                $http.patch($scope.apiUrl + '/category/' + $scope.category.id, $scope.category).success(function (data) {
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
                $http.post($scope.apiUrl + '/category', $scope.category).success(function (data) {
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
        var yes = confirm("Bạn có thực sự muốn xóa \"" + item.title + "\"?");
        if (yes) {
            $http.get($scope.apiUrl + "/category?filters=parent_id=" + item.id).success(function (data) {
                if (data.status == "successful") {
                    if (data.meta.total_count > 0) {
                        showMessage('Error', "Danh mục tồn tại danh mục con ", 'error', 'glyphicon-remove');
                        return
                    }
                    $http.delete($scope.apiUrl + "/category/" + item.id).success(function (data) {
                        if (data.status === "successful") {
                            $scope.reset();
                            $scope.find(true);
                        } else {
                            alert(data.message);
                            return;
                        }
                    });
                    $scope.parents = data.result;
//                $scope.filter.page_id = data.meta.page_id;
//                $scope.pagesCount = data.page_count;
                }
            }).error(function () {
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

        $http.get($scope.apiUrl + "/category" + buildFilter()).success(function (data) {
            $scope.hideLoading();
            if (data.status == "successful") {
                $scope.categories = data.result;
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
        if ($scope.filter.title) {
            filter += 'title~' + $scope.filter.title + ',';
        }
        if ($scope.filter.parent_id) {
            filter += 'parent_id=' + $scope.filter.parent_id.id + ',';
        }
        if ($scope.filter.status) {
            filter += 'status=' + $scope.filter.status.value + ',';
        }
        if ($scope.filter.type) {
            filter += 'type=' + $scope.filter.type.value + ',';
        }
        if (isParent) {
            filter += 'parent_id=0,';
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
    