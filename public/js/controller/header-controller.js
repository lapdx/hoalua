

system.controller("HeaderController", HeaderController);
/**
 * 
 * @param {type} $scope
 * @param {type} $rootScope
 * @param {type} $interval
 * @param {type} $http
 * @param {type} $document
 * @param {type} $timeout
 * @returns {undefined}
 */
function HeaderController($scope, $rootScope, $interval, $http, $document, $timeout) {
    //--------------------------------------------------------------------------
    $scope.controllerName = "HeaderController";
    $rootScope.isFinding = false;

    //  Initialize
    this.__proto__ = new BaseController($scope, $http);

    this.initialize = function ( ) {
    };
        $scope.$on("header.showLoading", function () {
        $scope.isShowLoading = true;
    });

    $scope.$on("header.hideLoading", function () {
        $scope.isShowLoading = false;
    });
    this.initialize( );
}