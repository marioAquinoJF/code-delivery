angular.module('starter.controllers')
        .controller('ClientCheckoutSuccessfullCtrl',
                ['$scope', '$state', '$cart', 
                    function ($scope, $state, $cart)
                    {
                        var cart = $cart.get();
                        console.log(cart.cupom);
                        $scope.cupom = cart.cupom;
                        $scope.items = cart.items;
                        $scope.total = $cart.getTotalFinal();
                        $cart.clear();
                        $scope.openListOrder = function(){
                            $state.go('client.orders');
                        };
                    }]);