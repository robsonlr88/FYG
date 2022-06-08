angular.module("ewtg").factory("myPropertiesAPI", function($http){

    var _getProperties = function (id){
        return $http.get("backend/myProperties.php?id=" + id);
    };

    return {
        getProperties: _getProperties
    };

});