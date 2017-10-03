(function () {
    "use strict";

    angular
        .module("pageApp")
        .controller("registroCtrl", registroCtrl);

    registroCtrl.$inject = ['pageModel', '$location', '$routeParams','utilities','$scope'];

    function registroCtrl(pageModel, $location, $routeParam,utilities,$scope) {
        
        var vm = this;
        $scope.forms = {};
        vm.estudiante = {};
        vm.message = '';
        
        $('#js-datetimepicker').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#js-datetimepicker input').click(function (event) {
            $('#js-datetimepicker').data("DateTimePicker").show();
        });

        vm.submit = function () {
            vm.estudiante.birth = $("#inputbirthDate").val();
            pageModel.register(vm.estudiante).then(function (result) {
                var dataJson = result;
                try {
                    if (dataJson.status === "ok") {
                        utilities.message("Se ha registrado correctamente", "Atención", "success");
                        vm.estudiante = {};
                        $scope.forms.estudianteForm.$setValidity();
                        $scope.forms.estudianteForm.$setPristine();
                        
                    } else {
                        if (dataJson.data === "NoSession") {
                            document.location.href = "index.html?BackPageSession=NoSession";
                        } else {
                            utilities.message("Error", "Atención", "danger");
                        }
                    }
                } catch (e) {
                    utilities.message("Error", "Atención", "danger");
                }
            });
        }

        
    }

    angular
        .module("pageApp")
        .controller("loginCtrl", loginCtrl);

    loginCtrl.$inject = ['pageModel', '$location', '$routeParams','utilities'];
       
    function loginCtrl(pageModel, $location, $routeParam,utilities) {
        
        var vm = this;
        vm.login = {};
        vm.message = '';
        
        
        vm.ingresar = function () {
            
            pageModel.login(vm.login).then(function (result) {
                var dataJson = result;
                try {
                    if (dataJson.status === "ok") {
                       document.location.href = dataJson.data;
                        
                    } else {
                        if (dataJson.data === "NoSession") {
                            document.location.href = "index.html";
                        } else {
                            utilities.message("Error", "Atención", "danger");
                        }
                    }
                } catch (e) {
                    utilities.message("Error", "Atención", "danger");
                }
            });
        }

        
    }
    
}());