angular.module('starter.services')
        .service('$cart', ['$localStorage', function ($localStorage)
            {
                var key = 'cart',
                        cartAux = $localStorage.getObject(key);
                console.log(cartAux);
                if (!cartAux) {
                    initCart();
                }
                this.clear = function ()
                {
                    $localStorage.setObject(key, {
                        items: [],
                        total: 0
                    });
                };
                this.get = function ()
                {
                    return $localStorage.getObject(key);
                };
                this.getItem = function (index)
                {
                    return this.get().items[index];
                };
                this.addItem = function (item)
                {
                    var cart = this.get(),
                            itemAux,
                            exists = false;
                    for (var i in cart.items) {
                        itemAux = cart.items[i];
                        if (itemAux.id == item.id) {
                            itemAux.quantity = item.quantity + itemAux.quantity;
                            itemAux.subtotal = calculateSubTotal(itemAux);
                            exists = true;
                            break;
                        }

                    }
                    if (!exists) {
                        item.subtotal = calculateSubTotal(item);
                        cart.items.push(item);
                    }
                    cart.total = getTotal(cart.items);
                    $localStorage.setObject(key, cart);
                };
                this.removeItem = function (index)
                {
                    var cart = this.get();
                    cart.items.splice(index, 1);
                    cart.total = getTotal(cart.items);
                    $localStorage.setObject(key, cart);
                };
                this.updateQuantity = function (index, quantity)
                {
                    var cart = this.get(),
                            itemAux = cart.items[index];
                    itemAux.quantity = quantity;
                    itemAux.subtotal = calculateSubTotal(itemAux);
                    cart.total = getTotal(cart.items);
                    $localStorage.setObject(key, cart);
                };

                function calculateSubTotal(item)
                {
                    return item.price * item.quantity;
                }
                function getTotal(items)
                {
                    var sum = 0;
                    angular.forEach(items, function (item)
                    {
                        sum += item.subtotal;
                    });
                    return sum;
                }
                function initCart()
                {
                    $localStorage.setObject(key, {
                        items: [],
                        total: 0
                    });
                }
            }]);