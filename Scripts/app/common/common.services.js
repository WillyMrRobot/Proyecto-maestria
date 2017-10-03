(function () {
    "use strict";

    angular
        .module("common.services",
            ["ngResource"])
        .constant("appSettings", {
            serverPath: "http://localhost:6910"
            //serverPath: "https://www4.avaya.com/BlitzTool/WebAPI/"
        });

}());