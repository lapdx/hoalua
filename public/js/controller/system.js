
var system = angular.module("system", ["ngSanitize", "ngAnimate", "ngFileUpload","dynamicNumber"]);
system.run(function ($http) {
    $http.defaults.headers.common.Authorization = "Basic YXBpOnRyYW5kdW9uZ0AyMzc=";
});
system.config(['dynamicNumberStrategyProvider', function (dynamicNumberStrategyProvider) {
        dynamicNumberStrategyProvider.addStrategy('price', {
            numInt: 9,
            numFract: 4,
            numSep: '.',
            numThousand: true
        });
    }]);
