(function () {
	"use strict";
	angular
		.module("actividadesApp")
		.controller("lecturaCtrl", lecturaCtrl);

    lecturaCtrl.$inject = ["$scope", "servicesActivities", "$route", "$routeParams", "$location", "$log", "$q", "$timeout", "utilities"];

	function lecturaCtrl($scope, servicesActivities, $route, $routeParams, $location, $log, $q, $timeout, utilities) {
		//loading.show();
		var vm = this;

		vm.validarSesion = function () {
			servicesActivities.validarSesion().then(function (result) {
				var dataJson = result;
				try {
					if (dataJson.status === "ok") {
						vm.usuario = dataJson.name;
						$(".userName").html(vm.usuario);
						vm.getAllEntries();
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

		vm.getAllEntries = function () {
            vm.topics = [{
                "userFoto":"profeAleja.jpg", 
                "userName":"ALEJANDRA SILVA", 
                "titulo":"CÓMO LAS LEYES DE NEWTON PUEDEN AYUDARTE A SER MÁS EFICIENTE",
                "id_publicacion":"ce3e2a45-241b-4790-a107-f261fd9cb26c",
                "comentarios":"3",
                "visto":"4",
                "fecha_creacion":"2018/03/19"
            },
            {
                "userFoto":"profeAleja.jpg", 
                "userName":"ALEJANDRA SILVA", 
                "titulo":"FAMILIA, PODER Y ECONOMÍA",
                "id_publicacion":"f2fddefc-64e1-4485-a413-7d6349992821",
                "comentarios":"3",
                "visto":"4",
                "fecha_creacion":"2018/03/19"
            }]
            $('[data-toggle="tooltip"]').tooltip();
        }
               
        vm.comment = function(id_publicacion) {
			//alert(id_publicacion);
			$location.path('lecturas/'+id_publicacion);
		}
	}
}());




         
    
      
     


