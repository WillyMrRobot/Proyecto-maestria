(function () {
    'use strict';
    // dataservice factory
    angular
        .module('pageApp')
        .factory('pageModel', pageModel);

    pageModel.$inject = ['$http','$q'];

    function pageModel($http,$q) {
        
        function handleError(response) {
            if (!angular.isObject(response.data) || !response.data.message) {
                return ($q.reject("Ha ocurrido un error."));
            }
            return ($q.reject(response.data.message));
	}

	function handleSuccess(response) {
            return (response.data);
        }
		
	function getArticulo(categoriaId,articuloId) {
            var request = $http({method: 'POST', url:'Api/GetArticulo.php',headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
                data: {'categoriaId':categoriaId, 'articuloId' : articuloId}
            });
            return (request.then(handleSuccess, handleError));
        }

    function register(estudiante) {
            var request = $http({method: 'POST', url:'Api/Register.php',headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
                data: {'firstName':estudiante.firstName,
                       'lastName' : estudiante.lastName,
                       'email' : estudiante.email,
                       'password' : estudiante.password,
                       'curso' : estudiante.curso,
                       'birth' : estudiante.birth                       
                     }
            });
            return (request.then(handleSuccess, handleError));
    }

    function login(data) {
            var request = $http({method: 'POST', url:'Api/Login.php',headers: {'Content-Type': 'application/x-www-form-urlencoded'}, 
                data: {'email' : data.email,
                       'password' : data.password                                              
                     }
            });
            return (request.then(handleSuccess, handleError));
    }

	return ({
        register:register,
        login: login,        
        getArticulo: getArticulo
	});
                
    }
})();