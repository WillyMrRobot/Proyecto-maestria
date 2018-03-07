(function () {
	"use strict";
	angular
		.module("actividadesApp")
		.controller("blogDetailCtrl", blogDetailCtrl);

		blogDetailCtrl.$inject = ["$scope", "servicesActivities", "$route", "$routeParams", "$location", "$log", "$q", "$timeout", "utilities"];

	function blogDetailCtrl($scope, servicesActivities, $route, $routeParams, $location, $log, $q, $timeout, utilities) {
		//loading.show();
		var vm = this;

		vm.validarSesion = function () {
			servicesActivities.validarSesion().then(function (result) {
				var dataJson = result;
				try {
					if (dataJson.status === "ok") {
						vm.usuario = dataJson.name;
						$(".userName").html(vm.usuario);
						vm.id_publicacion = $routeParams.id_publicacion;
						if (vm.id_publicacion) {
							vm.getEntry(vm.id_publicacion);
							vm.getEntryComments(vm.id_publicacion);
						} else {
							$location.path('/foro');
						}
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

		vm.getEntry = function (id_publicacion) {
			servicesActivities.getEntry(id_publicacion).then(function (result) {
				var dataJson = result;
				try {
					if (dataJson.status === "ok") {
						vm.entry = dataJson.data;
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

		vm.getEntryComments = function (id_publicacion) {
			servicesActivities.getEntryComments(id_publicacion).then(function (result) {
				var dataJson = result;
				try {
					if (dataJson.status === "ok") {
						vm.comments = dataJson.data;
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
	}
}());
