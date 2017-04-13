angular.module('starter.controllers')
        .controller('ClientViewProductCtrl',
                ['$scope', '$ionicLoading', '$state', 'Product', '$cart',
                    function ($scope, $ionicLoading, $state, Product, $cart)
                    {
                        $scope.products = [];
                        $ionicLoading.show({
                            template: "Carregando..."
                        });
                        Product.query({}, function (data)
                        {
                            $scope.products = data.data;
                            $ionicLoading.hide();
                        }, function (dataError)
                        {
                            $ionicLoading.hide();
                        });

                        $scope.addItem = function (item)
                        {
                            item.quantity = 1;
                            $cart.addItem(item);
                            $state.go('client.checkout');
                        };

                    }]);