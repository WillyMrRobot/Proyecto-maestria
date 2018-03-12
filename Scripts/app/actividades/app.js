(function () {
    "use strict";
    
    var app = angular.module("actividadesApp", ['ngRoute', 'ngSanitize', 'common.services']);

    app.directive('dynamic', function ($compile) {
        return {
            restrict: 'A',
            replace: true,
            scope: {dynamic: '=dynamic'},
            link: function postLink(scope, element, attrs) {
                scope.$watch('dynamic', function (html) {
                    element.html(html);
                    $compile(element.contents())(scope);
                });
            }
        };
    });
    
    angular
        .module('actividadesApp')
        .config(config);

    function config($routeProvider) {
        $routeProvider
                .when('/', {
                    templateUrl: 'Vistas/Actividades/inicio.html',
                    controller: 'inicioCtrl',
                    controllerAs: 'vm'
                })
                .when('/inicio', {
                    templateUrl: 'Vistas/Actividades/inicio.html',
                    controller: 'inicioCtrl',
                    controllerAs: 'vm'
                })
                .when('/habilidadesCriticas', {
                    templateUrl: 'Vistas/Actividades/habilidadesCriticas.html',
                    controller: 'habilidadesCtrl',
                    controllerAs: 'vm'
                })
                .when('/foro/:id_publicacion', {
                    templateUrl: 'Vistas/Actividades/blog_detail.html',
                    controller: 'blogDetailCtrl',
                    controllerAs: 'vm'
                })
                .when('/foro', {
                    templateUrl: 'Vistas/Actividades/blog_list.html',
                    controller: 'blogCtrl',
                    controllerAs: 'vm'
                })
                
            ;
    }
}());