system.controller("MenuController", MenuController);
/**
 *
 * @param {type} $scope
 * @param {type} $rootScope
 * @param {type} $http
 * @param {type} $window
 * @returns {undefined}
 */
function MenuController($scope, $rootScope, $http, $window) {
    //--------------------------------------------------------------------------
    //  Members
    var self = this;
//    $scope.params = params;
    $scope.menu = {};
    $scope.param = {};
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
        $http.get($scope.apiUrl+ "/parameter?page_id=0&page_size=200&sorts=-id&filters=param_key~site.menu").success(function (data) {
            $scope.hideLoading();
            $scope.param = data.result[0];
            $scope.menus = JSON.parse(data.result[0].param_value);
        });
    };
    $scope.find();
    $scope.push = function(item, array){
        if(item && array){
            array.push(angular.copy(item));
            $scope.menu = {};
            $scope.add();
        }

    }

    $scope.remove = function(index, array){
        if(index > -1 && array){
            array.splice(index, 1);
            $scope.add();
        }
    }
        $scope.add = function () {
        $scope.showLoading();
        $scope.param.param_value = JSON.stringify($scope.menus);
        $http.patch($scope.apiUrl+ "/parameter/"+$scope.param.id, $scope.param).success(function (data) {
            $scope.hideLoading();
            if (data.status == 'fail') {
                self.cloneObject($scope.preUpdateParam, param);
                alert("Xảy ra lỗi trong quá trình xử lý!");
            } else {
                $scope.find();
            }
        });
    };

//    this.initialize( );

}
