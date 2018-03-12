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

    function getAllEntries() {
        var request = $http({
            method: 'POST', url: "Api/GetAllEntries.php", headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
            data: {key: 'key'}
        });
        return (request.then(handleSuccess, handleError));
    }

    function getEntry(id_publicacion) {
        var request = $http({method: 'POST', url:'Api/GetEntry.php',headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
            data: {'id_publicacion':id_publicacion}
        });
        return (request.then(handleSuccess, handleError));
    }

    function getEntryComments(id_publicacion) {
        var request = $http({method: 'POST', url:'Api/GetEntryComments.php',headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
            data: {'id_publicacion':id_publicacion}
        });
        return (request.then(handleSuccess, handleError));
    }

    function sendComment(comment) {
        var request = $http({method: 'POST', url:'Api/EnviarComentario.php',headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
            data: {'id_publicacion':comment.id_publicacion,
                   'comentario' : comment.comentario,
                   'id_parent_comment':comment.id_parent_comment
                  }
        });
        return (request.then(handleSuccess, handleError));
    }   

    

	return ({
        validarPreguntas:validarPreguntas,
        validarSesion:validarSesion,
        registrarRespuestas:registrarRespuestas,
        getAllEntries:getAllEntries,
        getEntry:getEntry,
        getEntryComments:getEntryComments,
        sendComment:sendComment
	});
                
    }
})();