angular.module('starter.controllers')
        .controller('ClientCheckoutCtrl',
                ['$scope', '$state', '$cart', '$ionicLoading', '$ionicPopup', 'Order',
                    function ($scope, $state, $cart, $ionicLoading, $ionicPopup, Order)
                    {
                        var cart = $cart.get();

                        $scope.items = cart.items;
                        $scope.total = cart.total;
                        $scope.showDelete = false;
                        $scope.removeItem = function (i)
                        {
                            $cart.removeItem(i);
                            $scope.items.splice(i, 1);
                            $scope.total = $cart.get().total;
                        };
                        $scope.openProductDatail = function (i)
                        {
                            $state.go('client.checkout_item_detail', {index: i});
                        };
                        $scope.opeListProducts = function ()
                        {
                            $state.go('client.view_products');
                        };
                        $scope.save = function ()
                        {
                            var items = angular.copy($scope.items);
                            angular.forEach(items, function (item)
                            {
                                item.product_id = item.id;
                            });
                            $ionicLoading.show({
                                template: "Salvando..."
                            });
                            Order.save({id: null}, {items: items},
                                    function (response)
                                    {
                                        $ionicLoading.hide();
                                        $state.go('client.checkout_successfull');
                                    },
                                    function (responseError)
                                    {
                                        $ionicLoading.hide();
                                        $ionicPopup.alert({
                                            title: "Advertência!",
                                            template: 'Pedido não realizado - tente novamente'
                                        });
                                    });
                        };
                    }]);