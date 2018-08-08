system.controller("SettingController", SettingController);
/**
 *
 * @param {type} $scope
 * @param {type} $rootScope
 * @param {type} $http
 * @param {type} $window
 * @returns {undefined}
 */
function SettingController($scope, $rootScope, $http, $window) {
    //--------------------------------------------------------------------------
    //  Members
    var self = this;
//    $scope.params = params;
    $scope.keyword = "";
    $scope.newParam = {};
    $scope.preUpdateParam = {};
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
        $http.get($scope.apiUrl+ "/parameter?page_id=0&page_size=200&sorts=-id&filters=param_key~"+$scope.keyword).success(function (data) {
            $scope.hideLoading();
            $scope.params = data.result;
        });
    };
    $scope.find();
    /**
     * Delete a param
     *
     */
    $scope.delete = function (param) {
        if (!confirm("Bạn có muốn xóa tham số: " + JSON.stringify(param.param_key))) {
            return;
        }
        $scope.showLoading();
        $http.delete($scope.apiUrl+"/parameter/"+param.id).success(function (data) {
            $scope.hideLoading();
            if (data.status == "fail") {
                alert("Xảy ra lỗi trong quá trình xử lý!");
            } else {
                var deletedIndex = -1;
                for (var i = 0; i < $scope.params.length; i++) {
                    if ($scope.params[i] === param) {
                        deletedIndex = i;
                        break;
                    }
                }
                $scope.params.splice(deletedIndex, 1);
            }
        });
    };
    /**
     * Add a param
     *
     */
    $scope.add = function () {
        if ($scope.newParam.param_key == null || $scope.newParam.param_key == "") {
            alert("Yêu cầu nhập KEY!");
            return;
        }
        $scope.showLoading();
        $http.post($scope.apiUrl+ "/parameter", $scope.newParam).success(function (data) {
            $scope.hideLoading();
            if (data.status == 'fail') {
                alert("Lỗi! Key có thể đã được tạo trước đó!");
            } else {
                $scope.newParam.id = data.id;
                $scope.params.unshift($scope.newParam);
                $scope.newParam = {};
            }
        });
    };
    /**
     * Update a param
     *
     */
    $scope.update = function (param) {
        if (param.param_key == null || param.param_key == "") {
            alert("Yêu cầu nhập KEY!");
            return;
        }
        $scope.showLoading();
        delete param.edit;
        $http.patch($scope.apiUrl+ "/parameter/"+param.id, param).success(function (data) {
            $scope.hideLoading();
            if (data.status == 'fail') {
                self.cloneObject($scope.preUpdateParam, param);
                alert("Xảy ra lỗi trong quá trình xử lý!");
            } else {
            }
        });
    };
    /**
     * Cancel update a param
     *
     */
    $scope.cancelUpdate = function (param) {
        param.edit = false;
        self.cloneObject($scope.preUpdateParam, param);
    };
    /**
     * Show update param form
     *
     */
    $scope.showUpdate = function (param) {
        self.cloneObject(param, $scope.preUpdateParam);
        param.edit = true;
    };
    /**
     * Clone a object
     * @param {} source
     * @param {} destination
     */
    this.cloneObject = function (source, destination) {
        for (var key in source) {
            destination[key] = source[key];
        }
    };
//    this.initialize( );

}
