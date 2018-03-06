(function () {
    "use strict";
    angular
        .module("actividadesApp")
        .controller("blogCtrl", blogCtrl);

    blogCtrl.$inject = ["$scope","servicesActivities", "$route", "$routeParams", "$location", "$log", "$q", "$timeout","utilities"];
    
    function blogCtrl($scope,servicesActivities, $route, $routeParams, $location, $log, $q, $timeout,utilities) {
        //loading.show();
        var vm = this;
        
        vm.validarSesion = function() {
            servicesActivities.validarSesion().then(function (result) {
                var dataJson = result;
                try {
                    if (dataJson.status === "ok") {
                       vm.usuario = dataJson.name;
                       $(".userName").html(vm.usuario);
                    } else {
                        if (dataJson.data === "NoSession") {
                            document.location.href = "usuario.html";
                        } else {
                            utilities.message("Error", "Atención", "danger");
                        }
                    }
                } catch (e) {
                    utilities.message("Error", "Atención", "danger");
                }
            });   
        }
        
        vm.validarSesion();

        vm.getAllBlogsEntries = function() {
            servicesActivities.getAllBlogsEntries().then(function (result) {
                var dataJson = result;
                try {
                    if (dataJson.status === "ok") {
                       vm.pintarBlogs();
                    } else {
                        if (dataJson.data === "NoSession") {
                            document.location.href = "usuario.html";
                        } else {
                            utilities.message("Error", "Atención", "danger");
                        }
                    }
                } catch (e) {
                    utilities.message("Error", "Atención", "danger");
                }
            }); 
        }

    }
}());
