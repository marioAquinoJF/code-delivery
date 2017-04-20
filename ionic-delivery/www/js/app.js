
angular.module('starter.controllers', []);
angular.module('starter.services', []);
angular.module('starter', ['ionic', 'starter.controllers', 
    'starter.services', 'angular-oauth2', 'ngResource', 'ngCordova'])
        .constant('appConfig', {
            baseUrl: 'http://192.168.1.10:8000'
        })
        .run(function ($ionicPlatform)
        {
            $ionicPlatform.ready(function ()
            {
                if (window.cordova && window.cordova.plugins.Keyboard) {
                    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
                    // for form inputs)
                    cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

                    // Don't remove this line unless you know what you are doing. It stops the viewport
                    // from snapping when text inputs are focused. Ionic handles this internally for
                    // a much nicer keyboard experience.
                    cordova.plugins.Keyboard.disableScroll(true);
                }
                if (window.StatusBar) {
                    StatusBar.styleDefault();
                }
            });
        })
        .config(['$stateProvider', '$urlRouterProvider', '$provide', 'OAuthProvider', 'OAuthTokenProvider', 'appConfig',
            function ($stateProvider, $urlRouterProvider, $provide, OAuthProvider, OAuthTokenProvider, appConfig)
            {
                OAuthProvider.configure({
                    baseUrl: appConfig.baseUrl,
                    clientId: 'appid01',
                    clientSecret: 'secret', // optional
                    grantPath: '/oauth/access_token'
                });
                OAuthTokenProvider.configure({
                    name: 'token',
                    options: {
                        secure: false, // sem https
                    }
                });
                $stateProvider

                        .state('login', {
                            url: '/login',
                            templateUrl: 'templates/login.html',
                            controller: 'LoginCtrl'
                        })
                        .state('home', {
                            url: '/home',
                            templateUrl: 'templates/home.html',
                            controller: 'HomeCtrl'
                        })
                        .state('client', {
                            url: '/client',
                            abstract: true,
                            template: '<ion-nav-view/>'
                        })
                        .state('client.checkout', {
                            cache: false,
                            url: '/checkout',
                            templateUrl: 'templates/client/checkout.html',
                            controller: 'ClientCheckoutCtrl'
                        })
                        .state('client.checkout_item_detail', {
                            url: '/checkout/detail/:index',
                            templateUrl: 'templates/client/checkout-detail.html',
                            controller: 'ClientCheckoutDetailCtrl'
                        })
                        .state('client.checkout_successfull', {
                            cache: false,
                            url: '/checkout_successfull',
                            templateUrl: 'templates/client/checkout-successfull.html',
                            controller: 'ClientCheckoutSuccessfullCtrl'
                        })
                        .state('client.orders', {
                            url: '/orders',
                            templateUrl: 'templates/client/orders-list.html',
                            controller: 'ClientOrderListCtrl'
                        })
                        .state('client.view_products', {
                            url: '/view_products',
                            templateUrl: 'templates/client/view-product.html',
                            controller: 'ClientViewProductCtrl'
                        });
                $urlRouterProvider.otherwise('/login');
                $provide.decorator('OAuthToken', ['$localStorage', '$delegate',
                    function ($localStorage, $delegate)
                    {
                        Object.defineProperties($delegate, {
                            setToken: {
                                value: function (data)
                                {
                                    return $localStorage.setObject('token', data);
                                },
                                enumerable: true,
                                configurable: true,
                                writable: true
                            },
                            getToken: {
                                value: function ()
                                {
                                    return $localStorage.getObject('token');
                                },
                                enumerable: true,
                                configurable: true,
                                writable: true

                            },
                            removeToken: {
                                value: function ()
                                {
                                    return $localStorage.setObject('token', null);
                                },
                                enumerable: true,
                                configurable: true,
                                writable: true

                            }
                        });
                        return $delegate;
                    }
                ]);
            }]);