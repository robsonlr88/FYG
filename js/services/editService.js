angular.module("ewtg").factory("editPropertyAPI", function($http){

    var _editProperty = function (property){
        return $http.post("backend/editUpdate.php", property);

    };

    var _getProperty = function (id){
        return $http.get("backend/editGet.php?id=" + id);
    };

    var _getPropertyId = function (id){
        return $http.get("sql/sqlGetPropertyId.php?id=" + id);
    };

    var _getId = function (id){
        return $http.get("backend/createInfoSearchId.php?id=" + id);
    };

    var _getIdPictures = function (id){
        return $http.get("backend/createPicturesSearchId.php?id=" + id);
    };

    return {
        editProperty: _editProperty,
        getProperty: _getProperty,
        getPropertyId: _getPropertyId,
        getId: _getId,
        getIdPictures: _getIdPictures,
    };

});

