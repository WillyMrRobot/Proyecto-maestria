(function () {
    "use strict";
    angular
        .module("actividadesApp")
        .controller("inicioCtrl", inicioCtrl);

    inicioCtrl.$inject = ["$scope","servicesActivities", "$route", "$routeParams", "$location", "$log", "$q", "$timeout"];
    
    function inicioCtrl($scope,servicesActivities, $route, $routeParams, $location, $log, $q, $timeout) {
        //loading.show();
        var vm = this;

        var oTableReq;
        //$("body").addClass("sidebar-collapse");
        
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


    }
}());