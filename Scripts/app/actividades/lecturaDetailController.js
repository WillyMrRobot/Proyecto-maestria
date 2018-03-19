(function () {
	"use strict";
	angular
		.module("actividadesApp")
		.controller("lecturaDetailCtrl", lecturaDetailCtrl);

    lecturaDetailCtrl.$inject = ["$scope", "servicesActivities", "$route", "$routeParams", "$location", "$log", "$q", "$timeout", "utilities","$compile"];

	function lecturaDetailCtrl($scope, servicesActivities, $route, $routeParams, $location, $log, $q, $timeout, utilities,$compile) {
		//loading.show();
        var vm = this;
        vm.id_publicacion = $routeParams.id_publicacion;
        vm.lecturas = [{
            "id_publicacion":"ce3e2a45-241b-4790-a107-f261fd9cb26c",
            "id_lectura":"578fd8d0-4467-4967-a5d4-58b1da853748",
            "template":"newton.docx",
            "nombre":"CÓMO LAS LEYES DE NEWTON PUEDEN AYUDARTE A SER MÁS EFICIENTE"
        },{
            "id_publicacion":"f2fddefc-64e1-4485-a413-7d6349992821",
            "id_lectura":"ec3eb14b-83ae-4024-a73a-5ddd13221600",
            "template":"familiaPoderEconomia.docx",
            "nombre":"FAMILIA, PODER Y ECONOMÍA"
        }];

		vm.validarSesion = function () {
			servicesActivities.validarSesion().then(function (result) {
				var dataJson = result;
				try {
					if (dataJson.status === "ok") {
						vm.usuario = dataJson.name;
						$(".userName").html(vm.usuario);
						vm.filterLecturaByPublicacion(vm.id_publicacion);
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
        
        vm.filterLecturaByPublicacion = function(id_publicacion) {
            vm.lectura = utilities.searchIntoJson(vm.lecturas,"id_publicacion",id_publicacion);
        }
		       
        vm.download = function(name) {
            var sUrl = 'documents/'+name;
            document.getElementById('my_iframe').src = sUrl;
        };
	}
}());




         
    
      
     

 
 

   

function ajaxFileUpload() {
    if ($("#filew").val() !== "") {
        myApp.showPleaseWait("Cargando documento. Por favor espere...");
        var idUserProcess = QueryString.idUserProcess;
        
        var datae = { filew:'filew',idUserProcess:idUserProcess };
        
        $.ajaxFileUpload
        ({
            url: '../../Controlador/ps_userprocess/uploadSignDocument.php',
            secureuri: false,
            fileElementId: 'filew',
            dataType: 'text',
            data: datae,
            
            success: function (data, status) {
                myApp.hidePleaseWait();
                myApp.hidePleaseWait();
                var tales = data.indexOf("Error:");
                if (tales !== -1) {
                    message (data,"Alerta","danger");  
                } else  {
                    myApp.hidePleaseWait();
                    $("#filew").css('display','none');
                    $("#load").css('display','none');
                    message("Archivo cargado correctamente.. Redireccionando", "Atención", "danger");
                    setTimeout(function () {
                        document.location.href = "admin_tramites.php";
                    }, 2000);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var data = jqXHR.responseText;
                var tales = data.indexOf("Error:");
                if (tales !== -1) {
                    cargaArchivo = false;
                    myApp.hidePleaseWait();
                    message(data, "Attention", "danger");
                } else {
                    cargaArchivo = false;
                    myApp.hidePleaseWait();
                    message(data, "Attention", "danger");
                }
                    
                
            }
        });
    } else {
        message("Debe seleccionar un documento a cargar","Atención","danger");
    }
    return false;
};


