angular.module('starter.controllers')
        .controller('ClientCheckoutDetailCtrl',
                ['$scope', '$state', '$stateParams', '$cart',
                    function ($scope, $state, $stateParams, $cart)
                    {
                        var index = $stateParams.index;
                        $scope.product = $cart.getItem(index);
                        $scope.updateQuantity = function(){
                          $cart.updateQuantity(index, $scope.product.quantity);
                          $state.go('client.checkout');
                        };
                    }]);