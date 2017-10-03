(function () {
    "use strict";

    angular
        .module("common.services")
        .factory("utilities", utilities);

    //estudiantesResource.$inject = ["$resource", "appSettings"];

    function utilities() {
        
       return {
           searchIntoJson : function (obj, column, value) {
               var results = [];
               var searchField = column;
               var searchVal = value;
               for (var i = 0; i < obj.length; i++) {
                   if (obj[i][searchField] == searchVal) {
                       results.push(obj[i]);
                   }
               }
               return results;
           },
           message : function(texto, titulo, tipo) {

               BootstrapDialog.show({
                   title: titulo,
                   message: texto,
                   cssClass: 'type-' + tipo
               });
               return false;

           },

           newAlert : function (message, titulo, type) {
               $("#alert-area").html('');
               $("#alert-area").append($("<div class='alert alert-" + type + " alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>" + titulo + "</strong>" + message + "</div>"));
               window.setTimeout(function () {
                   $("#alert-area").fadeTo(500, 0).slideUp(500, function () {
                       $(this).html('');
                       $(this).css('display', 'inline');
                       $(this).css('opacity', '1');
                   });
               }, 3000);
           },
           loadingShow: function (texto) {
                    var pleaseWaitDiv = "";
                    if (texto !== undefined) {
                        pleaseWaitDiv = $('<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-dialog" style="width:500px!important;top: 90px;"> <div class="modal-content" style="background-color:rgba(255, 255, 255,1);border-radius: 5px;"> <div class="modal-header" style="padding-top:5px!important;padding-bottom:5px!important;padding-left:15px;padding-right:15px;border-bottom: 0px!important;"> <h4 style="text-align:center;"><strong style="color:#cc0000;">' + texto + '</strong> &nbsp;&nbsp;&nbsp; <img src="images/gears32.gif" /></h4></div></div></div></div>');
                    } else {
                        pleaseWaitDiv = $('<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-dialog" style="width:200px!important;top: 90px;"> <div class="modal-content" style="background-color:rgba(255, 255, 255,1);border-radius: 5px;"> <div class="modal-header" style="padding-top:5px!important;padding-bottom:5px!important;padding-left:15px;padding-right:15px;border-bottom: 0px!important;"> <h4 style="text-align:center;"><strong style="color:#cc0000;">Loading...</strong> &nbsp;&nbsp;&nbsp; <img src="images/gears32.gif" /></h4></div></div></div></div>');
                    }
                    pleaseWaitDiv.modal();
           },
           loadingHide: function() {
               $("#pleaseWaitDialog").remove();
               $(".modal-backdrop").remove();
           },
           limpiarFormulario: function (obj) {
                for (var i in obj) {
                    $("#" + i + "Add").val("");
                    $("#" + i + "AddMsg").removeClass("has-error");
                }
            }
       }
    }

   
}());


