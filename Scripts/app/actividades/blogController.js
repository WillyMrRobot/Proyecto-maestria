(function () {
	"use strict";
	angular
		.module("actividadesApp")
		.controller("blogCtrl", blogCtrl);

	blogCtrl.$inject = ["$scope", "servicesActivities", "$route", "$routeParams", "$location", "$log", "$q", "$timeout", "utilities"];

	function blogCtrl($scope, servicesActivities, $route, $routeParams, $location, $log, $q, $timeout, utilities) {
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
			servicesActivities.getAllEntries().then(function (result) {
				var dataJson = result;
				try {
					if (dataJson.status === "ok") {
						vm.topics = dataJson.data;
					} else {
						if (dataJson.data === "NoSession") {
							document.location.href = "usuario.html";
						} else {
							utilities.message("Error", "Atención", "danger");
						}
					}
					$('[data-toggle="tooltip"]').tooltip();
				} catch (e) {
					utilities.message("Error", "Atención", "danger");
				}
			});
		}

		vm.comment = function(id_publicacion) {
			//alert(id_publicacion);
			$location.path('foro/'+id_publicacion);
		}
	}
}());
