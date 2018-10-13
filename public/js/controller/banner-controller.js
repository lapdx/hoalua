system.controller("BannerController", BannerController);
/**
 *
 * @param {type} $scope
 * @param {type} $rootScope
 * @param {type} $http
 * @param {type} $window
 * @returns {undefined}
 */
function BannerController($scope, $rootScope, $http, $window, Upload) {
    //--------------------------------------------------------------------------
    //  Members
    var self = this;
    $scope.banners = [];
    $scope.param = {};
    $scope.uploadPath = '/upload/';
    $scope.types = [
        {name: "Home", value: "home"},
        {name: "Left", value: "left"},
        {name: "Right", value: "right"},
        {name: "Middle", value: "mid"}
    ];
    $scope.banner = {
        image_url: null,
        link: '',
        type: {name: "Home", value: "home"}
    };
    //--------------------------------------------------------------------------
    //  Initialize
    $scope.baseController = this.__proto__ = new BaseController($scope, $http, $rootScope);
    this.initialize = function ( ) {
        this.__proto__.initialize(function ( ) {
        });
    };
    /**
     * Find params
     *
     */
    $scope.find = function () {
        $scope.showLoading();
        $http.get($scope.apiUrl + "/parameter?page_id=0&page_size=200&sorts=-id&filters=param_key=slides.banner").success(function (data) {
            $scope.hideLoading();
            $scope.param = data.result[0];
            $scope.banners = JSON.parse($scope.param.param_value);
        });
    };
    $scope.find();
    /**
     * Delete a param
     *
     */
    $scope.delete = function (index) {
        if (!confirm("Bạn có muốn xóa banner này! ")) {
            return;
        }
        $scope.banners.splice(index, 1);
        $scope.param.param_value = JSON.stringify($scope.banners);
        $http.patch($scope.apiUrl + '/parameter/' + $scope.param.id, $scope.param).success(function (data) {
            if (data.status == "fail") {
                showMessage('Error', "Thêm mới thất bại " + data.message, 'error', 'glyphicon-remove');
                $('.save').button('reset');
            } else {
                $('.save').button('reset');
                $scope.reset();
                $scope.find();
            }
            $('#createManufacturer').modal('hide');
        });
    };

    $scope.openDialog = function (mode, banner) {
        $scope.mode = mode;
        $scope.formTitle = 'Tạo mới banner';
        $scope.reset();
    };
    $scope.reset = function () {
        $scope.banner = {
            image_url: null,
            link: '',
            type: {name: "Home", value: "home"}
        };
        $scope.find();

    };
    $scope.save = function () {
        $('.save').button('loading');
        if ($scope.banner.image_url == null || typeof $scope.banner.image_url != 'object') {
            $('.save').button('reset');
            showMessage('Error', "Vui lòng chọn ảnh", 'error', 'glyphicon-remove');
            return;
        }
        $scope.banner.type = $scope.banner.type.value;
        Upload.upload({
            url: $scope.apiUrl + "/upload",
            file: $scope.banner.image_url
        }).error(function (data, status, headers, config) {
            console.log('error status: ' + status);
            console.log('error' + data);
        }).success(function (data) {
            if (data.status == 'successful') {
                var relativePath = data.result;
                $scope.banner.image_url = relativePath;
                $scope.banners.push($scope.banner);
                $scope.param.param_value = JSON.stringify($scope.banners);
                $http.patch($scope.apiUrl + '/parameter/' + $scope.param.id, $scope.param).success(function (data) {
                    if (data.status == "fail") {
                        showMessage('Error', "Thêm mới thất bại " + data.message, 'error', 'glyphicon-remove');
                        $('.save').button('reset');
                    } else {
                        $('.save').button('reset');
                        $scope.reset();
                        $scope.find();
                    }
                    $('#createManufacturer').modal('hide');
                });
            }
        });
    };
    $scope.showImageWhenChooseFile = function (selectorShowImage) {
        if ($scope.banner.image_url != null) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(selectorShowImage).attr('src', e.target.result);
            };
            reader.readAsDataURL($scope.banner.image_url);
            $(selectorShowImage).show();
            $(selectorShowImage).removeClass('ng-hide');
        }

    };
//    this.initialize( );

}
