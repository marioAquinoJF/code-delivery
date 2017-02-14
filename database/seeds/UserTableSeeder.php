<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Delivery\Models\User::class)->create(
                [
                    'name' => 'mario',
                    'email' => 'mario@mario.com',
                    'role' => 'admin',
                    'password' => bcrypt(123456),
                    'remember_token' => str_random(10),
                ]
        )->client()->save(factory(Delivery\Models\Client::class)->make());
        factory(Delivery\Models\User::class)->create(
                [
                    'name' => 'cliente mario',
                    'email' => 'mario.client@mario.com',
                    'role' => 'client',
                    'password' => bcrypt(123456),
                    'remember_token' => str_random(10),
                ]
        )->client()->save(factory(Delivery\Models\Client::class)->make());
       
        factory(Delivery\Models\User::class, 3)->create(
                [
                    'role' => 'deliveryMan',
                ]
        );
        factory(Delivery\Models\User::class)->create(
                [
                    'name' => 'mario',
                    'email' => 'admin@admin.com',
                    'role' => 'admin',
                    'password' => bcrypt(123456),
                    'remember_token' => str_random(10),
                ]
        );
        factory(\Delivery\Models\User::class, 10)->create()->each(function($u) {
            $u->client()->save(factory(\Delivery\Models\Client::class)->make());
        });
    }

}
