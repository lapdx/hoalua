
var system = angular.module("system", ["ngSanitize", "ngAnimate", "ngFileUpload"]);
system.run(function ($http) {
    $http.defaults.headers.common.Authorization = "Basic YXBpOnRyYW5kdW9uZ0AyMzc=";
});