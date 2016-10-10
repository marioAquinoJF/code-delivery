<?php

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | Here you may define all of your model factories. Model factories give
  | you a convenient way to create models for testing and seeding your
  | database. Just tell the factory how a default model should look.
  |
 */

$factory->define(Delivery\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Delivery\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Delivery\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'category_id' => rand(1, 10),
        'description' => $faker->paragraph,
        'price' => $faker->numberBetween(10, 50)
    ];
});

$factory->define(Delivery\Models\Order::class, function (Faker\Generator $faker) {
    return [
        'user_deliveryman_id' => rand(1, 2),
        'client_id' => rand(3, 11)
    ];
});

$factory->define(Delivery\Models\OrderItem::class, function (Faker\Generator $faker) {
    return [
        'product_id' => rand(1, 50),
        'price' => $faker->randomFloat(2, 15, 1500),
        'quantity' => $faker->randomNumber(2)
    ];
});

$factory->define(Delivery\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => $faker->postcode
    ];
});
