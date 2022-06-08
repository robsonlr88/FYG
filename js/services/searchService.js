angular.module("ewtg").factory("searchAPI", function($http){

    var _getProperties = function (id){
        return $http.get("backend/properties.php", {'search':property});
    };

    var _getSearch = function (property){
        return $http.post("backend/search.php", {property})
    };

    var _getIdSearch = function (id){
        return $http.get("backend/searchSearchId.php?id=" + id);
    };

    var _getId = function (id){
        return $http.get("backend/createInfoSearchId.php?id=" + id);
    };

    var _propertyView = function (id){
        return $http.get("backend/view.php?id=" + id);
    };

    return {
        getProperties: _getProperties,
        getSearch: _getSearch,
        getId: _getId,
        getIdSearch: _getIdSearch,
        propertyView: _propertyView
    };

});

