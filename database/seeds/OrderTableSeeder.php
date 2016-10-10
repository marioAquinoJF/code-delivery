<?php

use Illuminate\Database\Seeder;
use Delivery\Models\Order;
use Delivery\Models\OrderItem;
use Delivery\Models\User;
use Delivery\Models\Product;

class OrderTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 50)->create()->each(function($o) {
            for ($i = 0; $i < 10; $i++)
            {
                $o->items()->save(factory(OrderItem::class)->make());
            }
        });
    }

}
