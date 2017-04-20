angular.module('starter.controllers')
        .controller('ClientCheckoutCtrl',
                ['$scope', '$state', '$cart', '$ionicLoading',
                    '$ionicPopup', '$cordovaBarcodeScanner', 'Order', 'Cupom',
                    function ($scope, $state, $cart, $ionicLoading,
                            $ionicPopup, $cordovaBarcodeScanner, Order, Cupom)
                    {

                        var cart = $cart.get();

                        $scope.cupom = cart.cupom;
                        $scope.items = cart.items;
                        $scope.total = $cart.getTotalFinal();
                        $scope.showDelete = false;
                        $scope.removeItem = function (i)
                        {
                            $cart.removeItem(i);
                            $scope.items.splice(i, 1);
                            $scope.total = $cart.getTotalFinal();
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
                            var o = {
                                items: angular.copy($scope.items)
                            };
                            var validate = $cart.validate();
                            
                            angular.forEach(o.items, function (item)
                            {
                                item.product_id = item.id;
                            });
                            $ionicLoading.show({
                                template: "Salvando..."
                            });
                            
                            if (validate.value) {
                                Order.save({id: null}, o,
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
                            } else {
                                $ionicLoading.hide();
                                $ionicPopup.alert({
                                    title: "Advertência!",
                                    template: validate.message
                                });
                            }
                        };

                        $scope.readBarCode = function ()
                        {
                            $cordovaBarcodeScanner
                                    .scan()
                                    .then(function (barcodeData)
                                    {
                                        getValueCupom(barcodeData.text);
                                    }, function (error)
                                    {
                                        $ionicPopup.alert({
                                            title: "Advertência!",
                                            template: 'Não foi possível ler o código de barras!\n\
                                                        Tente Novamente!'
                                        });
                                    });
                        };
                        $scope.removeCupom = function ()
                        {
                            $cart.removeCupom();
                            $scope.cupom = $cart.get().cupom;
                            $scope.total = $cart.getTotalFinal();
                        };

                        // private functions
                        function getValueCupom(code)
                        {
                            $ionicLoading.show({
                                template: "Carregando..."
                            });
                            Cupom.get({code: code},
                                    function (response)
                                    {
                                        var cupom = response.data;
                                        $cart.setCupom(cupom.code, cupom.value);
                                        $scope.cupom = $cart.get().cupom;
                                        $scope.total = $cart.getTotalFinal();
                                        $ionicLoading.hide();
                                    },
                                    function (responseError)
                                    {
                                        $ionicLoading.hide();
                                        $ionicPopup.alert({
                                            title: "Advertência!",
                                            template: 'Não foi possível encontrar o cupom!\n\
                                                Cupom Inválido!'
                                        });
                                    });
                        }

                    }]);