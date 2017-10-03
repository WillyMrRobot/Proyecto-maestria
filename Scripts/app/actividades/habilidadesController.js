(function () {
    "use strict";
    angular
        .module("actividadesApp")
        .controller("habilidadesCtrl", habilidadesCtrl);

    habilidadesCtrl.$inject = ["$scope","servicesActivities", "$route", "$routeParams", "$location", "$log", "$q", "$timeout","utilities"];
    
    function habilidadesCtrl($scope,servicesActivities, $route, $routeParams, $location, $log, $q, $timeout,utilities) {
        //loading.show();
        var vm = this;
        vm.preguntas = "";
        vm.dilema = {};
        vm.numero = 0;

        vm.validarPreguntas = function() {
            servicesActivities.validarPreguntas().then(function (result) {
                var dataJson = result;
                try {
                    if (dataJson.status === "ok") {
                       vm.preguntas = dataJson.data;
                       vm.numero = vm.preguntas.split(",");
                       if (vm.numero.length === 7) {
                            utilities.message("Muchas gracias por participar!", "Completado", "success");          
                        }
                    } 
                } catch (e) {
                    utilities.message("Error", "Atención", "danger");
                }
            });   
        }

        vm.validarSesion = function() {
            servicesActivities.validarSesion().then(function (result) {
                var dataJson = result;
                try {
                    if (dataJson.status === "ok") {
                       vm.usuario = dataJson.name;
                       $(".userName").html(vm.usuario);
                       vm.validarPreguntas();
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
        
        vm.registrarRespuestas = function (dilema) {
            utilities.loadingShow();
            vm.dilema.preguntaId = dilema;
            var dilemaName = "dilema" + dilema;
            vm.dilema.respuestaId =  $("input:radio[name ="+ dilemaName +"]:checked").val();
            servicesActivities.registrarRespuestas(vm.dilema).then(function (result) {
                var dataJson = result;
                utilities.loadingHide();
                try {
                    if (dataJson.status === "ok") {
                       utilities.message("Se ha guardado la respuesta seleccionada", "Guardada","success");
                       setTimeout(function() {
                            $scope.$apply(function() {
                                vm.preguntas += "," + vm.dilema.preguntaId;
                            });
                        }, 100);
                        vm.numero = vm.preguntas.split(",");
                        if (vm.numero.length === 7) {
                            utilities.message("Muchas gracias por participar!", "Completado", "success");          
                        }
                        vm.validarPreguntas();
                    } else {
                        if (dataJson.data === "NoSession") {
                            document.location.href = "usuario.html";
                        } else {
                            utilities.message("Error", "Atención", "danger");
                        }
                    }
                } catch (e) {
                    utilities.loadingHide();
                    utilities.message("Error", "Atención", "danger");
                }
            }); 
        }


        vm.validarSesion();

    }
}());
