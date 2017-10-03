(function () {
    "use strict";


    var app = angular.module("pageApp", ['ngRoute', 'ngSanitize', 'common.services', 'ngAnimate']);

    angular.module("pageApp").filter('cmdate', [
        '$filter', function ($filter) {
            return function (input, format) {
                return $filter('date')(new Date(input), format).toUpperCase();
            };
        }
    ]);

    
    
}());