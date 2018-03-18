(function () {
	"use strict";
	angular
		.module("actividadesApp")
		.controller("blogDetailCtrl", blogDetailCtrl);

		blogDetailCtrl.$inject = ["$scope", "servicesActivities", "$route", "$routeParams", "$location", "$log", "$q", "$timeout", "utilities","$compile"];

	function blogDetailCtrl($scope, servicesActivities, $route, $routeParams, $location, $log, $q, $timeout, utilities,$compile) {
		//loading.show();
		var vm = this;
		vm.parent = {};

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
						var compiledHtml = $compile(vm.entry.contenido)($scope);
						$('#contenido').append(compiledHtml);
					} else {
						if (dataJson.data === "NoSession") {
							document.location.href = "usuario.html";
						} else {
							//utilities.message("Error", "Atención", "danger");
						}
					}
				} catch (e) {
					//utilities.message("Error", "Atención", "danger");
				}
			});
		}

		vm.getEntryComments = function (id_publicacion) {
			servicesActivities.getEntryComments(id_publicacion).then(function (result) {
				var dataJson = result;
				try {
					if (dataJson.status === "ok") {
						vm.comments = dataJson.data;
						vm.paintComments(vm.comments);
					} else {
						if (dataJson.data === "NoSession") {
							document.location.href = "usuario.html";
						} else {
							//utilities.message("Error", "Atención", "danger");
						}
					}
				} catch (e) {
					//utilities.message("Error", "Atención", "danger");
				}
			});
		}
		
		vm.commentsPainted = [];

		vm.formatData = function(comment,parent) {
			var comentarioPadre = (parent.length === 0) ? "" : "<strong>En respuesta a :</strong> " + parent[0].comentario + "&nbsp;--" + parent[0].userName;
			return `<dynamic id="`+comment.id_comentario+`">
								<div class="row" style="margin-top:5px;padding-top:5px;background-color:white;">
									<div class="col-xs-12"><p style="font-style: italic;font-size: 10px;background-color:#e8e8e8;">`+comentarioPadre+`</p></div>
									<div class="col-xs-2">
										<p>`+comment.userName+`<br/>
											<i class="fa fa-calendar"/>&nbsp;`+comment.fecha_creacion+`
										</p>
									</div>
									<div class="col-xs-8">`+comment.comentario+`</div>
									<div class="col-xs-2">
										<button class="btn btn-primary" ng-click="vm.dejarComentario('`+comment.id_comentario+`')" value="Comentar">Comentar</button>
									</div>
								</div>
							</dynamic>`;
		}

		vm.dejarComentario = function(id_comentario) {
			var template = `<div class="card my-4">
						<h5 class="card-header">Deja un comentario:</h5>
						<div class="card-body">
							<form>
								<div class="form-group" style="margin-bottom:2px!important;">
									<textarea class="form-control" rows="3" id="` + id_comentario + `Comment"></textarea>
								</div>
								<button type="submit" class="btn btn-primary" id="` + id_comentario + `Button" ng-click="vm.guardarComentario('` + vm.id_publicacion + `','` + id_comentario + `')">Enviar</button>
							</form>
						</div>
					</div>`;
			var compiledHtml = $compile(template)($scope);
			$('#'+id_comentario).append(compiledHtml);		
		}

		vm.paint = function(data) {
			var compiledHtml = $compile(data)($scope);
			$('#comments').append(compiledHtml);
		}

		vm.guardarComentario = function (id_publicacion,id_parent_comment) {
			$("#"+id_parent_comment + "Button").prop("disabled", true);
			vm.parent.id_publicacion = id_publicacion;
			vm.parent.id_parent_comment = id_parent_comment;
			vm.parent.comentario = (id_parent_comment == 0) ? $("#parentComment").val() : $("#" + id_parent_comment + "Comment").val();
			servicesActivities.sendComment(vm.parent).then(function (result) {
				var dataJson = result;
				try {
					if (dataJson.status === "ok") {
						utilities.message("Comentario guardado", "Información", "success");
						$('#comments').empty();
						vm.getEntryComments(vm.id_publicacion);
					} else {
						if (dataJson.data === "NoSession") {
							document.location.href = "usuario.html";
						} else {
							//utilities.message("Error", "Atención", "danger");
						}
					}
				} catch (e) {
					//utilities.message("Error", "Atención", "danger");
				}
			});
		}

		vm.paintComments = function(comments) {
			if (comments !== "[]") {
				angular.forEach(comments, function(value, key) {
					var pintado = $.inArray(value.id_comentario, vm.commentsPainted);
					if (pintado = -1) {
							var haveParent = utilities.searchIntoJson(comments, "id_comentario", value.id_parent_comment);
							var dataHtml = vm.formatData(value,haveParent);
							vm.paint(dataHtml);
							vm.commentsPainted.push(value.id_comentario);
							// var filterComments = utilities.searchIntoJson(comments, "id_parent_comment", value.id_comentario);
							// if (filterComments !== "[]" ) {
							// 	vm.paintComments(filterComents);
							// }
					}
				});
			}
		}

		vm.paintComments_old = function(comments) {
			angular.forEach(comments, function(value, key) {
				var pintado = $.inArray(value.id_comentario, vm.commentsPainted);
				if (pintado = -1) {
					if (value.id_parent_comment == "0") {
						var dataHtml = vm.formatData(value);
						vm.paint(dataHtml);
						vm.commentsPainted.push(value.id_comentario);
						var filterComments = utilities.searchIntoJson(comments, "id_parent_comment", value.id_comentario);
						if (filterComments.length > 0 ) {
							vm.paintComments(filterComents);
						}
					} else {
						var dataHtml = vm.formatData(value);
						var compiledHtml = $compile(dataHtml)($scope);
						$('#comments').append(compiledHtml);
						vm.commentsPainted.push(value.id_comentario);
						var filterComments = utilities.searchIntoJson(comments, "id_parent_comment", value.id_comentario);
						if (filterComments.length > 0 ) {
							vm.paintComments(filterComents);
						}
					}
				}
			});
		}
	}
}());
