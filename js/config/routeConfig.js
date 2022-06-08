angular.module("ewtg").config(function ($routeProvider, $locationProvider) {
    $locationProvider.hashPrefix('');

        $routeProvider
        .when('/', {
            templateUrl: 'view/home.html',
            controller: 'loginCtrl'
        })
        .when('/propertyInfo', {
            templateUrl: 'view/createInfo.html',
            controller: 'propertyInfoCtrl'
        })
        .when('/propertyInfo/:id', {
            templateUrl: 'view/createInfo.html',
            controller: 'propertyInfoCtrl'
        })
        .when('/propertyResources/:id', {
            templateUrl: "view/createResources.html",
            controller: "propertyResourcesCtrl"
        })
        .when('/propertySurroundings/:id', {
            templateUrl: "view/createSurroundings.html",
            controller: "propertySurroundingsCtrl"
        })  
        .when('/propertyPricing/:id', {
            templateUrl: "view/createPricing.html",
            controller: "propertyPricingCtrl"
        })
        .when("/insertPictures/:id", {
            templateUrl: "view/createPicturesInsert.html",
            controller: "propertyPicturesCtrl"
        })
        .when("/review/:id", {
            templateUrl: "view/createReview.html",
            controller: "editPropertyCtrl"
        })
        .when('/editProperty/:id', {
            templateUrl: 'view/edit.html',
            controller: 'editPropertyCtrl'
        })
        .when('/editPictures/:id', {
            templateUrl: 'view/editPictures.html',
            controller: 'editPicturesCtrl'
        })
        .when('/login', {
            templateUrl: 'view/login.html',
            controller: 'loginCtrl'
        })
        .when('/signup', {
            templateUrl: 'view/signup.html',
            controller: 'signupCtrl'
        })
        .when('/verify-email/:id', {
            templateUrl: 'view/signupVerified.html',
            controller: 'signupCtrl',
        })
        .when('/signupConfirmEmail', {
            templateUrl: 'view/signupConfirmEmail.html',
            controller: 'signupCtrl',
        })
        .when('/profile/:id', {
            templateUrl: 'view/profile.html',
            controller: 'profileCtrl'
        })
        .when('/myProperties/:id', {
            templateUrl: 'view/myProperties.html',
            controller: 'myPropertiesCtrl',
        })
        .when("/search", {
            templateUrl: "view/search.html",
            controller: "searchCtrl"
        })
        .when("/property/:id", {
            templateUrl: "view/property.html",
            controller: "searchCtrl"
        })
        .otherwise({
            redirectTo: '/'
        });
});