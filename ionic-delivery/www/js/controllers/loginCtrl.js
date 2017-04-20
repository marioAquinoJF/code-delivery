angular.module('starter.controllers')
        .controller('LoginCtrl',
                ['$scope', 'OAuth', '$state', '$ionicPopup',
                    function ($scope, OAuth, $state, $ionicPopup)
                    {
                        $scope.user = {
                            username: '',
                            password: ''
                        };
                        $scope.login = function ()
                        {
                            OAuth.getAccessToken($scope.user).then(
                                    function (data)
                                    {
                                        
                                        $state.go('client.checkout');
                                    },
                                    function (reponseError)
                                    {
                                        //     console.log(reponseError);
                                        $ionicPopup.alert({
                                            title: "Advertência!",
                                            template: 'Login e/ou senha inválidos!'
                                        });
                                    }
                            );
                        };
                    }]);


