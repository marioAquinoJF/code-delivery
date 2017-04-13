angular.module('starter.controllers')
        .controller('ClientOrderListCtrl',
                ['$scope', '$state', 'Order',
                    function ($scope, $state, Order)
                    {
                        $scope.orders = [];
                        $scope.orderCreateAt = '';
                        Order.query({}, 
                                function (response)
                                {
                                    console.log(response.data);
                                    $scope.orders = response.data;
                                },
                                function (responseError)
                                {

                                });
                    }]);