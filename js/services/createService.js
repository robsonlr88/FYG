angular.module("ewtg").factory("createAPI", function($http){

    // Info
    var _getIdInfo = function (id){
        return $http.get("backend/createInfoSearchId.php?id=" + id);
    };
    var _infoInsertUpdate = function (property){
        return $http.post("backend/createInfoInsertUpdate.php", property);
    };

    // Resources
    var _getIdResources = function (id){
        return $http.get("backend/createResourcesSearchId.php?id=" + id);
    };
    var _resourcesInsertUpdate = function (property){
        return $http.post("backend/createResourcesInsertUpdate.php", property);
    };

    // Surroundings
    var _getIdSurroundings = function (id){
        return $http.get("backend/createSurroundingsSearchId.php?id=" + id);
    };
    var _surroundingsInsertUpdate = function (property){
        return $http.post("backend/createSurroundingsInsertUpdate.php", property);
    };

    // Pricing
    var _getIdPricing = function (id){
        return $http.get("backend/createPricingSearchId.php?id=" + id);
    };

    var _pricingInsertUpdate = function (property){
        return $http.post("backend/createPricingInsertUpdate.php", property);
    };

    // Pictures
    var _getIdPictures = function (id){
        return $http.get("backend/createPicturesSearchId.php?id=" + id);
    };

    // Review
    var _reviewProperty = function (property){
        return $http.post("backend/createReview.php", property);

    };

    return {
        getIdInfo: _getIdInfo,
        infoInsertUpdate: _infoInsertUpdate,
        getIdResources: _getIdResources,
        resourcesInsertUpdate: _resourcesInsertUpdate,
        getIdSurroundings: _getIdSurroundings,
        surroundingsInsertUpdate: _surroundingsInsertUpdate,
        getIdPricing: _getIdPricing,
        pricingInsertUpdate: _pricingInsertUpdate,
        getIdPictures: _getIdPictures,
        reviewProperty: _reviewProperty

    };

});

