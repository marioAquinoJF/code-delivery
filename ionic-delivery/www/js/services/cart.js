angular.module('starter.services')
        .service('$cart', ['$localStorage', function ($localStorage)
            {
                var key = 'cart',
                        cartAux = $localStorage.getObject(key);
                if (!cartAux) {
                    initCart();
                }
                this.validate = function ()
                {
                    var cart = this.get(),
                            validation = {
                                message: '',
                                value: true
                            };
                    if (!(cart.cupom.value === null)) {
                        validation.value = cart.total > cart.cupom.value;
                        if (!validation.value) {
                            validation.message = 'O valor do cupom deve ser menor que o valor da compra!\n\
                                                <br/>\n\
                                                Valor da compra:' + cart.total + "<br/>\n\
                                                Valor do cupom:" + cart.cupom.value;
                        }
                    }
                    if (cart.total <= 0) {
                        validation.value = false;
                        validation.message += '<br/> Escolha um produto!';
                    }
                    return validation;
                };
                
                this.clear = function ()
                {
                    $localStorage.setObject(key, {
                        items: [],
                        total: 0,
                        cupom: {
                            code: null,
                            value: null
                        }
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
                this.setCupom = function (code, value)
                {
                    var cart = this.get();
                    cart.cupom = {
                        code: code,
                        value: value
                    };
                    $localStorage.setObject(key, cart);
                };
                this.removeCupom = function ()
                {
                    var cart = this.get();
                    cart.cupom = {
                        code: null,
                        value: null
                    };
                    $localStorage.setObject(key, cart);
                };

                this.getTotalFinal = function ()
                {
                    var cart = this.get();
                    return cart.total - (cart.cupom.value || 0);
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
                        total: 0,
                        cupom: {
                            code: null,
                            value: null
                        }
                    });
                }
            }]);