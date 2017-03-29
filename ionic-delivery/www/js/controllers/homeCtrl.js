angular.module('starter.controllers')
        .controller('HomeCtrl',
                ['$scope', '$cookies', '$http',
                    function ($scope, $cookies, $http)
                    {
                        $scope.user = '';
                        $http({
                            method: 'GET',
                            url: 'http://delivery/api/user'
                        }).then(function successCallback(response)
                        {                            
                            $scope.user = response.data.data;
                               console.log($scope.user);
                        }, function errorCallback(response)
                        {
                            console.log('erro');
                        });
                       

                    }]);



