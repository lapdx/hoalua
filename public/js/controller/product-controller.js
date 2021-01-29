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
system.controller("ProductController", ProductController);

/**
 * 
 * @param {type} $scope
 * @param {type} $http
 * @returns {undefined}
 */

function ProductController($scope, $rootScope, $http, $window, $timeout, Upload) {
    $scope.controllerName = "ProductController";
    $scope.products = [];
    $scope.uploadPath = '/upload/';
    $scope.isFinding = false;
    $scope.mode = '';
    $scope.formTitle = 'Tạo sản phẩm';
    $scope.filter = {};
    $scope.statuses = [{name: "Hiện", value: "active"}, {name: "Ẩn", value: "inactive"},{name: "Hot", value: "hot"},{name: "Mới", value: "new"}];
    $scope.product = {
        id: 0,
        title: '',
        slug: '',
        content: '',
        description: '',
        price: 0,
        sale_price: 0,
        manufacturer_id: 0,
        manufacturer: '',
        meta_title: '',
        meta_description: '',
        meta_keywords: '',
        sorder: 0,
        status: {name: "Hiện", value: "active"}
    };
    $scope.baseController = this.__proto__ = new BaseController($scope, $http, $rootScope);

    this.initialize = function ( ) {
        $http.get($scope.apiUrl + "/category?page_size=10000").success(function (data) {
            if (data.status == "successful") {
                $scope.categories = data.result;
                $('.select-two').select2();
            }
        }).error(function () {
        });
        $http.get($scope.apiUrl + "/manufacturer?page_size=10000").success(function (data) {
            if (data.status == "successful") {
                $scope.manufacturers = data.result;
                $('.select-two').select2();
            }
        }).error(function () {
        });
    };
    this.initialize();
    $scope.openDialogCreateOrUpdate = function (mode, product) {
        $scope.openDialog(mode, product);
    };
    $scope.openDialog = function (mode, product) {
        $scope.mode = mode;
        tinyMCE.remove();
        $scope.reset(true);
        $('#description').val('');
        if (mode === 'update' || mode === 'detail') {
            $scope.formTitle = 'Sửa bài viết';
            $scope.product = angular.copy(product);
            $scope.product.status = $scope.getByField($scope.statuses, "value", $scope.product.status);
            $scope.product.manufacturer = $scope.getByField($scope.manufacturers, "id", $scope.product.manufacturer_id);
            $scope.product.category = $scope.getByField($scope.categories, "id", $scope.product.category_id);
        }
        $timeout(function () {
            $scope.baseController.initTinymce("#description", 200, 0);
        });
    };


    $scope.reset = function (notResetFilter) {
        if (notResetFilter === null || typeof notResetFilter === 'undefined' || notResetFilter === false) {
            $scope.filter = {};
        }
        $scope.product = {
            id: 0,
            title: '',
            slug: '',
            content: '',
            meta_title: '',
            meta_description: '',
            meta_keywords: '',
            sorder: 0,
            status: {name: "Hiện", value: "active"}
        };
        $scope.find();

    };
    $scope.onTitleChange = function () {
        $scope.product.slug = $scope.toFriendlyString($scope.product.title);
    };
    /**
     * Lưu thông tin danh mục - create or update
     * @returns {undefined}
     */
    $scope.save = function () {
        $('.save').button('loading');
        if ($scope.product.title === '') {
            $('.save').button('reset');
            showMessage('Error', "Tên không được bỏ trống", 'error', 'glyphicon-remove');
            return;
        }
        if ($scope.product.image != null && typeof $scope.product.image == 'object') {
            Upload.upload({
                url: $scope.apiUrl + "/upload",
                file: $scope.product.image
            }).error(function (data, status, headers, config) {
                console.log('error status: ' + status);
                console.log('error' + data);
            }).success(function (data) {
                if (data.status == 'successful') {
                    var relativePath = data.result;
                    $scope.product.image_url = relativePath;
//                    $scope.product.image = relativePath.replace(/^.*[\\\/]/, '');
                    var url = '/product';
                    var method = "POST";
                    if ($scope.mode == "update") {
                        url += "/" + $scope.product.id;
                        method = 'PATCH';
                    }
                    $scope.sendRequest(method, url, builData(), function (data) {
                        if (data.status == "fail") {
                            showMessage('Error', "Cập nhật thất bại " + data.message, 'error', 'glyphicon-remove');
                            $('.save').button('reset');
                        } else {
                            $('.save').button('reset');
                            $scope.reset(true);
                            $scope.find();
                        }
                        $('#createManufacturer').modal('hide');
                    }, function (e) {
                        showErrors(e);
                    });
                }
            });
        } else {
            var url = '/product';
            var method = "POST";
            if ($scope.mode == "update") {
                url += "/" + $scope.product.id;
                method = 'PATCH';
            }
            $scope.sendRequest(method, url, builData(), function (data) {
                if (data.status == "fail") {
                    showMessage('Error', "Cập nhật thất bại " + data.message, 'error', 'glyphicon-remove');
                    $('.save').button('reset');
                } else {
                    $('.save').button('reset');
                    $scope.reset(true);
                    $scope.find();
                }
                $('#createManufacturer').modal('hide');
            }, function (e) {
                showErrors(e);
            });
        }
    };

    $scope.delete = function (item) {
        var yes = confirm("Bạn có thực sự muốn xóa \"" + item.title + "\"?");
        if (yes) {
            $http.delete($scope.apiUrl + "/product/" + item.id).success(function (data) {
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
    $scope.openFilterFrom = function (product) {
        $scope.product = angular.copy(product);
        $scope.product.attribute_values = [];
        $http.get($scope.apiUrl + "/attribute_values?page_id=-1&page_size=-1").success(function (data) {
            if (data.status == "successful") {
                $scope.attribute_values = data.result;
                $scope.attribute_values.forEach(function(item){
                    $scope.product.attribute_ids.forEach(function(attr){
                        if (item.id == attr.attribute_value_id) {
                        $scope.product.attribute_values.push(item);
                    }
                    });
                    
                });
                $timeout(function(){
                 $('.js-multiple-select').select2();
                });
            }
        }).error(function () {
        });
    }
    $scope.openGallery = function(product){
        $scope.product = angular.copy(product);
    }
    $scope.deleteImage = function (item) {
        var yes = confirm("Bạn có thực sự muốn xóa ảnh này?");
        if (yes) {
            $scope.sendRequest("DELETE", "/product_gallery?filters=id=" + item.id, {}, function (data) {
                if (data.status == "fail") {
                    showMessage('Error', "Xóa thất bại " + data.message, 'error', 'glyphicon-remove');
                } else {
                    $scope.loadGallery();
                }
            }, function (e) {
                showErrors(e);
            });
        }
    }
    $scope.loadGallery = function(){
                $http.get($scope.apiUrl + "/product_gallery?page_id=-1&page_size=-1&filters=product_id="+$scope.product.id).success(function (data) {
            if (data.status == "successful") {
                $scope.product.images = data.result;
            }
        }).error(function () {
        });
    }
    $scope.uploadFiles = function (file, errFiles) {
        $scope.file = file;
        $scope.errFile = errFiles && errFiles[0];
        if (file) {
            Upload.upload({
                url: $scope.apiUrl + "/upload",
                file: file
            }).error(function (data, status, headers, config) {
                console.log('error status: ' + status);
                console.log('error' + data);
            }).success(function (data) {
                if (data.status == 'successful') {
                    var relativePath = data.result;
                    var gallery = {product_id: $scope.product.id};
                    gallery.image_url = relativePath;
//                    $scope.product.image = relativePath.replace(/^.*[\\\/]/, '');
                    var url = '/product_gallery';
                    var method = "POST";
                    $scope.sendRequest(method, url, gallery, function (data) {
                        if (data.status == "fail") {
                            showMessage('Error', "Cập nhật thất bại " + data.message, 'error', 'glyphicon-remove');
                        } else {
                            $scope.loadGallery();
                        }
                        $('#createManufacturer').modal('hide');
                    }, function (e) {
                        showErrors(e);
                    });
                }
            });
        }
    }
    /**
     * find data by filter
     * @returns {undefined}
     */
    $scope.find = function (isChangePageData) {
        $scope.showLoading();
        if (isChangePageData) {
            $scope.filter.pageId = 0;
        }

        $http.get($scope.apiUrl + "/product" + buildFilter()).success(function (data) {
            $scope.hideLoading();
            if (data.status == "successful") {
                $scope.products = data.result;
                $scope.filter.pageId = data.meta.page_id;
                $scope.pagesCount = data.meta.page_count;
            }
        }).error(function () {
            $scope.hideLoading();
            alert("Không thể tải danh sách, vui lòng thử lại hoặc liên hệ bộ phận kỹ thuật để được hỗ trợ.");
        });
    };
    function buildFilter() {
        var retVal = '?embeds=attributeIds,images&';
        var dataFilter = {page_id: $scope.filter.pageId, page_size: 20, sorts: '-id'};
        retVal += $scope.baseController.encodeQueryData(dataFilter);
        var filter = '';
        if ($scope.filter.title) {
            filter += 'title~' + $scope.filter.title + ',';
        }
        if ($scope.filter.status) {
            filter += 'status=' + $scope.filter.status.value + ',';
        }
        if ($scope.filter.manufacturer) {
            filter += 'manufacturer_id=' + $scope.filter.manufacturer.id + ',';
        }
        if ($scope.filter.category) {
            filter += 'category_id=' + $scope.filter.category.id + ',';
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
        if ($scope.product.image != null) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(selectorShowImage).attr('src', e.target.result);
            };
            reader.readAsDataURL($scope.product.image);
            $(selectorShowImage).show();
            $(selectorShowImage).removeClass('ng-hide');
        }

    };
    
    function builData(){
       var content = tinyMCE.get('description').getContent();
       var retVal = {
            id: $scope.product.id,
            title: $scope.product.title,
            description: $scope.product.description,
            slug: $scope.product.slug,
            meta_title: $scope.product.meta_title,
            price: $scope.product.price,
            sale_price: $scope.product.sale_price,
            meta_description: $scope.product.meta_description,
            meta_keywords: $scope.product.meta_keywords,
            content: null,
            sorder: $scope.product.sorder,
            image_url: $scope.product.image_url,
            category_id: null,
            category_name: null,
            manufacturer_id: null,
            manufacturer: null,
            status: null,
        };
        if ($scope.product.manufacturer != null) {
            retVal.manufacturer_id = $scope.product.manufacturer.id;
            retVal.manufacturer = $scope.product.manufacturer.title;
        }
        if ($scope.product.category != null) {
            retVal.category_id = $scope.product.category.id;
            retVal.category_name = $scope.product.category.title;
        }
        if (typeof $scope.product.content != 'undefined') {
            retVal.content = content;
        }
        if (typeof $scope.product.status != 'undefined' && $scope.product.status != null) {
            retVal.status = $scope.product.status.value;
        }
        return retVal;
    }
        $scope.saveAttributes = function () {
        $scope.sendRequest("DELETE", "/product_n_attribute_value?filters=product_id=" + $scope.product.id, $scope.product, function (data) {
            if (data.status == "fail") {
                showMessage('Error', "Xóa thất bại " + data.message, 'error', 'glyphicon-remove');
                $('.save').button('reset');
            } else {
                
                $scope.sendRequest("POST", "/product_n_attribute_value", buildAttribute(), function (data) {
                    if (data.status == "fail") {
                        showMessage('Error', "Thêm thất bại " + data.message, 'error', 'glyphicon-remove');
                        $('.save').button('reset');
                    } else {
                       showMessage('Success', 'Đã cập nhật thuộc tính lọc.', 'success', 'glyphicon-ok');
                    }
                    $('#filterForm').modal('hide');
                }, function (e) {
                    showErrors(e);
                });
            }
        }, function (e) {
            showErrors(e);
        });
    }
    function buildAttribute(){
        var retVal = [];
        $scope.product.attribute_values.forEach(function(item){
            retVal.push({product_id:$scope.product.id,attribute_value_id:item.id})
        });
        return retVal;
    }
}
    