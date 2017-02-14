<?php

use Illuminate\Database\Seeder;

class CupomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Delivery\Models\Cupom::class, 10)->create();
    }
}
