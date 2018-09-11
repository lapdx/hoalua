system.controller("AttributeController", AttributeController);
/**
 *
 * @param {type} $scope
 * @param {type} $rootScope
 * @param {type} $http
 * @param {type} $window
 * @returns {undefined}
 */
function AttributeController($scope, $rootScope, $http, $window) {
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
    $scope.onNameChange = function () {
        $scope.newParam.param = $scope.toFriendlyString($scope.newParam.name);
    };
    /**
     * Find params
     *
     */
    $scope.find = function () {
        $scope.showLoading();
        $http.get($scope.apiUrl + "/attributes?page_id=0&page_size=200&sorts=-id&filters=name~" + $scope.keyword).success(function (data) {
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
        if (!confirm("Bạn có muốn xóa bộ lọc: " + JSON.stringify(param.name))) {
            return;
        }
        $scope.showLoading();
        $http.delete($scope.apiUrl + "/attributes/" + param.id).success(function (data) {
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
        if ($scope.newParam.name == null || $scope.newParam.name == "") {
            alert("Yêu cầu nhập Tên!");
            return;
        }
        $scope.showLoading();
        $http.post($scope.apiUrl + "/attributes", $scope.newParam).success(function (data) {
            $scope.hideLoading();
            if (data.status == 'fail') {
                alert("Lỗi! Bộ lọc có thể đã tồn tại!");
            } else {
                $scope.newParam.id = data.result.id;
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
        if (param.name == null || param.name == "") {
            alert("Yêu cầu nhập Tên!");
            return;
        }
        $scope.showLoading();
        delete param.edit;
        param.param = $scope.toFriendlyString(param.name);
        $http.patch($scope.apiUrl + "/attributes/" + param.id, param).success(function (data) {
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
