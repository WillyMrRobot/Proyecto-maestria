(function () {
    'use strict';
    // dataservice factory
    angular
        .module('actividadesApp')
        .factory('servicesActivities', servicesActivities);

    servicesActivities.$inject = ['$http','$q'];

    function servicesActivities($http,$q) {
        
        function handleError(response) {
            if (!angular.isObject(response.data) || !response.data.message) {
                return ($q.reject("Ha ocurrido un error."));
            }
            return ($q.reject(response.data.message));
	}

	function handleSuccess(response) {
            return (response.data);
        }
		
	function validarPreguntas() {
            var request = $http({method: 'POST', url:'Api/ValidarPreguntas.php',headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
                data: {key: 'key'}
            });
            return (request.then(handleSuccess, handleError));
        }

    function registrarRespuestas(respuesta) {
            var request = $http({method: 'POST', url:'Api/RegistrarRespuesta.php',headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
                data: {'preguntaId':respuesta.preguntaId,
                       'respuestaId' : respuesta.respuestaId
                      }
            });
            return (request.then(handleSuccess, handleError));
    }

    function validarSesion() {
        var request = $http({
            method: 'POST', url: "Api/ValidarSesion.php", headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
            data: {key: 'key'}
        });
        return (request.then(handleSuccess, handleError));
    }

	return ({
        validarPreguntas:validarPreguntas,
        validarSesion:validarSesion,
        registrarRespuestas:registrarRespuestas
	});
                
    }
})();